<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Movie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class MovieItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Movie::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Movie
    {
        // Retrieve the movie item from somewhere then return it or null if not found
        $request = HttpClient::create()->request('GET', 'https://api.themoviedb.org/3/movie/' . $id . '?api_key=d4d61572ec94db3d027fc4f8f84a3844');
        $statusCode = $request->getStatusCode();

        if ($request->getStatusCode() !== 200) {
            if ($request->getStatusCode() === 404) {
                return null;
            }

            throw new HttpException($request->getStatusCode(), Response::$statusTexts[$statusCode] ?? 'Unknown status code', null);
        }

        $data = $request->getContent();

        $data = \GuzzleHttp\json_decode($data, true);

        $releaseDateYear = (new \DateTime($data['release_date']))->format('y');

        return new Movie($data['imdb_id'], $data['title'], 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/' . $data['poster_path'], $releaseDateYear, $data['vote_average'], $data['vote_count']);
    }
}

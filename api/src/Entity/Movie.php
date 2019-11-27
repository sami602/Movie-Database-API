<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={"get"}
 * )
 */
class Movie
{
    /**
     * @ApiProperty(identifier=true)
     * @var string The IMDB ID
     */
    private $imdbId;

    /**
     * @var string The title of the movie
     */
    private $title;

    /**
     * @var string The link to the poster image
     */
    private $posterImageLink;

    /**
     * @var int The year the movie was released
     */
    private $year;

    /**
     * @var int The rating value of the movie
     */
    private $ratingValue;

    /**
     * @var int The number of votes
     */
    private $ratingCount;

    public function __construct(string $imdbId, string $title, string $link, int $year, int $ratingValue, int $ratingCount)
    {
        $this->imdbId = $imdbId;
        $this->title = $title;
        $this->posterImageLink = $link;
        $this->year = $year;
        $this->ratingValue = $ratingValue;
        $this->ratingCount = $ratingCount;
    }

    /**
     * @return string
     */
    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getPosterImageLink(): string
    {
        return $this->posterImageLink;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getRatingValue(): int
    {
        return $this->ratingValue;
    }

    /**
     * @return int
     */
    public function getRatingCount(): int
    {
        return $this->ratingCount;
    }
}

<?php

declare(strict_types=1);

namespace App;

use App\Entity\Movie;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ImdbClient
{
    /**
     * @var HttpClientInterface
     */
    private $imdb;
    /**
     * @var string
     */
    private $imdbApiKey;

    public function __construct(
        HttpClientInterface $imdb,
        string $imdbApiKey
    ) {
        $this->imdb = $imdb;
        $this->imdbApiKey = $imdbApiKey;
    }

    public function findMovieDetails(string $movieTitle): ?array
    {
        $response = $this->imdb->request(
            'GET',
            sprintf('SearchMovie/%s/%s', $this->imdbApiKey, $movieTitle)
        );

        return $response->toArray()['results'][0] ?? null;
    }
}

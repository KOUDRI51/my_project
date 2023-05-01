<?php


namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class MovieDbApiService
{
    private $httpClient;
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->httpClient = HttpClient::create();
        $this->apiKey = $apiKey;
    }

    public function getPopularMovies(): array
    {
        $response = $this->httpClient->request('GET', 'https://api.themoviedb.org/3/movie/popular', [
            'query' => [
                'api_key' => $this->apiKey,
            ],
        ]);

        return $response->toArray();
    }

    public function getPopularTVShows(): array
    {
        $response = $this->httpClient->request('GET', 'https://api.themoviedb.org/3/tv/popular', [
            'query' => [
                'api_key' => $this->apiKey,
            ],
        ]);

        return $response->toArray();
    }
}
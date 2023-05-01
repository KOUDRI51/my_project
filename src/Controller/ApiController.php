<?php

namespace App\Controller;

use App\Service\MovieDbApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController 
{
    private $movieDbApiService;

    // public function __construct(MovieDbApiService $movieDbApiService)
    // {
    //     $this->movieDbApiService = $movieDbApiService;
    // }

    /**
     * @Route("/movies/popular")
     */
    public function getPopularMovies(): Response
    {
        $movies = $this->movieDbApiService->getPopularMovies();
        return new JsonResponse($movies);
    }
}

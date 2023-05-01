<?php


namespace App\Controller;

use App\Service\MovieDbApiService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieController 

{
    private $movieDbApiService;

    public function __construct(MovieDbApiService $movieDbApiService)
    {
        
        $this->movieDbApiService = $movieDbApiService;
    }

    public function popularMovies(MovieDbApiService $movieDbApiService): JsonResponse
    {
        $movies = $movieDbApiService->getPopularMovies();

        return new JsonResponse($movies);
    }
}


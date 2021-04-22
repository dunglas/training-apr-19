<?php

namespace App\Controller;

use App\Entity\Movie;
use App\ImdbClient;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/movies', name: 'movie_')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('movie/index.html.twig', ['movies' => $movieRepository->findAll()]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @IsGranted("MOVIE_SHOW", subject="movie")
     */
    #[Route('/{id<\d+>}', name: 'detail')]
    public function detail(Movie $movie): Response
    {
        return $this->render('movie/detail.html.twig', [
            'movie' => $movie,
        ]);
    }
}

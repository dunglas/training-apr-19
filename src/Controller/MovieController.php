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

/**
 * @Route("/movies", name="movie_")
 */
class MovieController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('movie/index.html.twig', ['movies' => $movieRepository->findAll()]);
    }

    /**
     * @Route("/{id<\d+>}", name="detail")
     */
    public function detail(Movie $movie): Response
    {
        return $this->render('movie/detail.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, ImdbClient $imdbClient): Response
    {
        $imdbData = $imdbClient->findMovieDetails($request->get('title'));
        if (null === $imdbData) {
            throw new BadRequestException('Unable to found this movie on IMDB');
        }

        $m = new Movie();
        $m->setTitle($imdbData['title']);
        $m->setPoster($imdbData['image']);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($m);
        $manager->flush();

        return $this->redirectToRoute('movie_detail', ['id' => $m->getId()], Response::HTTP_SEE_OTHER);
    }
}

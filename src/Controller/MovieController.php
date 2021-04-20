<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movies', name: 'movie_')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('movie/index.html.twig', ['movies' => $movieRepository->findAll()]);
    }

    #[Route('/{id<\d+>}', name: 'detail')]
    public function detail(Movie $movie): Response
    {
        return $this->render('movie/detail.html.twig', ['movie' => $movie]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request): Response
    {
        $m = new Movie();
        $m->setTitle($request->get('title'));

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($m);
        $manager->flush();

        return $this->redirectToRoute('movie_detail', ['id' => $m->getId()], Response::HTTP_SEE_OTHER);
    }
}

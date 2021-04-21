<?php

namespace App\Controller;


use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/')]
final class HomepageController
{
    public function __invoke(MovieRepository $repository, Environment $twig): Response
    {
        return new Response(
            $twig->render('movie/index.html.twig', ['movies' => $repository->findLastSix()])
        );
    }
}
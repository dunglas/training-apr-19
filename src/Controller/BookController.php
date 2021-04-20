<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book', name: 'book_')]
class BookController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return new Response(sprintf('Page: %d</body>', 1));
    }

    /**
     * @Route("/{slug}", name="detail")
     */
    public function detail(string $slug): Response
    {
        return new Response('Slug: '.$slug.'</body>');
    }
}

<?php

namespace App\Controller;

use App\BookManager;
use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book', name: 'book_')]
class BookController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return new Response(sprintf('<body><h1>Books</h1> %d</body>', 1));
    }

    #[Route('/create')]
    public function create(Request $request, BookManager $bookManager): Response
    {
        $book = new Book();
        $book->setTitle($request->query->get('title'));

        $bookManager->addBook($book);

        return new Response(sprintf('Book %d added', $book->getId()));
    }

    /**
     * @Route("/{slug}", name="detail")
     */
    public function detail(string $slug): Response
    {
        return new Response('Slug: '.$slug.'</body>');
    }
}

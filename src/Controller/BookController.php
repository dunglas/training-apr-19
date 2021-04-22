<?php

namespace App\Controller;

use App\BookManager;
use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;

#[Route('/book', name: 'book_')]
class BookController extends AbstractController
{
    #[Route('/', name: 'index')]
    /**
     * @IsGranted("ROLE_USER")
     */
    public function index(Security $security): Response
    {
        if ($security->isGranted('ROLE_MODERATOR')) {
            $message = 'Welcome, Modo!';
        } else {
            $message = 'Welcome!';
        }

        return new Response(sprintf('<body><h1>Books</h1> %s</body>', $message));
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
     * @Route("/{id}", name="detail")
     * @ IsGranted("BOOK_UPDATE", subject="book")
     */
    public function detail(Book $book): Response
    {
        $this->denyAccessUnlessGranted('BOOK_UPDATE', $book);

        return new Response(sprintf(<<<HTML
<body>
<h1>%s</h1>
</body>
HTML, htmlspecialchars($book->getTitle()))
            );
    }
}

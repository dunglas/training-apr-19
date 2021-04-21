<?php

declare(strict_types=1);

namespace App;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

final class BookManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function addBook(Book $book)
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}

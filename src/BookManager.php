<?php

declare(strict_types=1);

namespace App;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

final class BookManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    public function addBook(Book $book)
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}

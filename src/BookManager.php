<?php

declare(strict_types=1);

namespace App;

use App\Entity\Book;
use App\Event\BookCreated;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class BookManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private EventDispatcherInterface $eventDispatcher,
    ) {}

    public function addBook(Book $book)
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();

        $this->eventDispatcher->dispatch(new BookCreated($book), BookCreated::NAME);
    }
}

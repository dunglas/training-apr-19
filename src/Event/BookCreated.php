<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Book;
use Symfony\Contracts\EventDispatcher\Event;

final class BookCreated extends Event
{
    public const NAME = 'book.created';

    public function __construct(private Book $book) {}

    public function getBook(): Book
    {
        return $this->book;
    }
}

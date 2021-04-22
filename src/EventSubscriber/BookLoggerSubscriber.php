<?php

namespace App\EventSubscriber;

use App\Event\BookCreated;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BookLoggerSubscriber implements EventSubscriberInterface
{
    public function __construct(private LoggerInterface $logger) {}

    public function onBookCreated(BookCreated $event)
    {
        $this->logger->info('Book create {book}', ['book' => $event->getBook()]);
    }

    public static function getSubscribedEvents()
    {
        return [
            BookCreated::NAME => 'onBookCreated',
        ];
    }
}

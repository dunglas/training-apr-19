<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class CustomSubscriber implements EventSubscriberInterface
{
    public function __construct()
    {
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        dump($event);
        $event->getResponse()->headers->set('X-Frame-Options', 'deny');
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.response' => 'onKernelResponse',
        ];
    }
}

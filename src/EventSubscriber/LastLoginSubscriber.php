<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class LastLoginSubscriber implements EventSubscriberInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function onSecurityAuthenticationSuccess(AuthenticationEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        if (!$user instanceof User) {
            return;
        }

        $user->setLastLogin(new \DateTimeImmutable());
        $this->entityManager->flush();
    }

    public static function getSubscribedEvents()
    {
        return [
            'security.authentication.success' => 'onSecurityAuthenticationSuccess',
        ];
    }
}

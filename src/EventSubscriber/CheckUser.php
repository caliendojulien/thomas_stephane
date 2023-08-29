<?php

namespace App\EventSubscriber;

use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;

class CheckUser implements EventSubscriberInterface
{

    #[NoReturn]
    public function checkUser(CheckPassportEvent $event):void {
        if (!$event->getPassport()->getUser()->isVerified()) {
            throw new CustomUserMessageAuthenticationException(
                'Compte non vérifié'
            );
        }
        if (!$event->getPassport()->getUser()->isVerified()) {
            throw new CustomUserMessageAuthenticationException(
                'Compte non actif'
            );
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CheckPassportEvent::class => ['checkUser', -1]
        ];
    }
}
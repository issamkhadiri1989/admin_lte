<?php

declare(strict_types=1);

namespace App\Subscriber\Security;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\TooManyLoginAttemptsAuthenticationException;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;

class LoginSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            LoginFailureEvent::class => 'alertPossibleBruteForceAttackAttempt',
        ];
    }

    public function alertPossibleBruteForceAttackAttempt(LoginFailureEvent $event): void
    {
        $exception = $event->getException();
        if ($exception instanceof TooManyLoginAttemptsAuthenticationException) {
            $request = $event->getRequest();

            // the username caused the denial
            $username  = $request->attributes->get('_security.last_username');

            // remote ip address
            $clientIp = $request->server->get('REMOTE_ADDR');

            // do something like alerting admin
        }
    }
}
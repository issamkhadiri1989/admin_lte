<?php

declare(strict_types=1);

namespace App\Service\Mailer;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class NotificationSender
{
    public function __construct(private readonly MailerInterface $mailer, private readonly MailerCreator $creator)
    {
    }

    public function sendConfirmationMail(UserInterface $user, string $plainPassword): void
    {
        $email = $this->creator->createConfirmationMail($user, $plainPassword);
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface) {

        }
    }
}

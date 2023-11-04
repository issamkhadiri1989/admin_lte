<?php

declare(strict_types=1);

namespace App\Service\Notification;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailNotifier
{
    public function __construct(private readonly MailerInterface $mailer)
    {
        dd(get_class($this->mailer));
    }

    public function sendMail(string $to): void
    {
        $email = (new TemplatedEmail())
            ->from('khadiri.issam@gmail.com')
            ->to($to)
            ->html('Hello all !');

        $this->mailer->send($email);
        // ...
    }
}
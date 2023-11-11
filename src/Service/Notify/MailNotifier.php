<?php

declare(strict_types=1);

namespace App\Service\Notify;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class MailNotifier
{
    public function __construct(
        private MailerInterface $mailer,
        private string $from
    ) {
    }

    public function notify(Address $to)
    {
        $message = (new TemplatedEmail())
            ->from($this->from)
            ->to($to)
            ->html('<p>ipsum lorem dolore');

        $this->mailer->send($message);
    }
}
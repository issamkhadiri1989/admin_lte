<?php

declare(strict_types=1);

namespace App\Notifier;

use Egulias\EmailValidator\Warning\AddressLiteral;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class MailNotifier
{
    public function __construct(private MailerInterface $mailer, private string $sender)
    {
    }

    public function notify(): void
    {
        $message = (new TemplatedEmail())
            ->from(new Address($this->sender))
            ->to(new Address('gi4@ehei.com'))
            ->html('You are the best');

        $this->mailer->send($message);
    }
}
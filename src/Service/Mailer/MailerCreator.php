<?php

declare(strict_types=1);

namespace App\Service\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\User\UserInterface;

class MailerCreator
{
    public function __construct(private string $systemAdminEmail)
    {
    }

    /**
     * Creates a simple email instance.
     *
     * @param UserInterface $destinationUser
     * @param string $randomPlainPassword
     *
     * @return Email
     */
    public function createConfirmationMail(UserInterface $destinationUser, string $randomPlainPassword,): Email
    {
        return $this->createSimpleMail($destinationUser, 'email/confirmation_email.html.twig', [
            'member' => $destinationUser,
            'password' => $randomPlainPassword,
        ]);
    }

    private function createSimpleMail(UserInterface $destinationUser, string $mailTemplate, array $context = []): Email
    {
        return (new TemplatedEmail())
            ->from($this->systemAdminEmail)
            ->to(new Address($destinationUser->getEmail(), $destinationUser->getFullName()))
            ->htmlTemplate($mailTemplate)
            ->context($context);
    }

    /**
     * Creates an email with attachment.
     *
     * @param UserInterface $destinationUser
     * @param string $mailTemplate
     * @param string $attachmentPath
     * @param array $context
     * @return Email
     */
    public function createMailWithAttachment(
        UserInterface $destinationUser,
        string        $mailTemplate,
        string        $attachmentPath,
        array         $context = []
    ): Email {
        return $this->createSimpleMail($destinationUser, $mailTemplate, $context)
            ->attachFromPath($attachmentPath);
    }
}

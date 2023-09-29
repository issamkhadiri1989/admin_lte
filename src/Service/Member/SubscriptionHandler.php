<?php

declare(strict_types=1);

namespace App\Service\Member;

use App\Service\Mailer\NotificationSender;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SubscriptionHandler
{
    public function __construct(private readonly UserManager $userManager, private readonly NotificationSender $sender,)
    {
    }

    public function handleSubscription(UserInterface|PasswordAuthenticatedUserInterface $member): void
    {
        $plainPassword = $this->userManager->createNewPasswordForUser($member);

        $this->userManager->saveUser($member);

        $this->sender->sendConfirmationMail($member, $plainPassword);
    }
}

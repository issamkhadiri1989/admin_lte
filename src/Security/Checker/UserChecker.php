<?php

declare(strict_types=1);

namespace App\Security\Checker;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    /**
     * @param User $user
     * @return void
     */
    public function checkPreAuth(UserInterface $user)
    {
        // before we authenticate the user, let's check if the account is banned.
        if ($user->isBanned() === true) {
            throw new CustomUserMessageAccountStatusException('Your account has been banned due to policies violation.');
        }
    }

    /**
     * @param User $user
     * @return void
     */
    public function checkPostAuth(UserInterface $user)
    {
        $expirationDate = $user->getExpirationDate();

        if (null !== $expirationDate && (new \DateTime() > $expirationDate)) {
            // maybe send some notification to the user's email telling him that the account is expired
            throw new AccountExpiredException('Your account is expired');
        }
    }
}
<?php

declare(strict_types=1);

namespace App\Service\Member;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use function rand;

class UserManager
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly EntityManagerInterface $manager
    ) {
    }

    /**
     * Creates a simple User instance.
     *
     * @return UserInterface
     */
    public function createNewInstance(): UserInterface
    {
        return (new User())
            ->setConfirmed(false)
            ->setEnabled(false);
    }

    /**
     * Generates and updates User's password.
     *
     * @param PasswordAuthenticatedUserInterface $user
     *
     * @return string
     */
    public function createNewPasswordForUser(PasswordAuthenticatedUserInterface $user): string
    {
        $plainPassword = $this->generateRandomPassword();

        $user->setPassword($this->passwordHasher->hashPassword($user, $plainPassword));

        return $plainPassword;
    }

    /**
     * Generates a random password.
     *
     * @return string
     */
    private function generateRandomPassword(): string
    {
        $randomPlainPassword = '';
        for ($i = 1; $i < 10; $i++) {
            $randomPlainPassword .= rand(0, 9);
        }

        return $randomPlainPassword;
    }

    /**
     * Persists the User instance into the database.
     *
     * @param UserInterface $user
     * @param bool $isNewEntry
     *
     * @return void
     */
    public function saveUser(UserInterface $user, bool $isNewEntry = true): void
    {
        if (true === $isNewEntry) {
            $this->manager->persist($user);
        }

        $this->manager->flush();
    }
}

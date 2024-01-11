<?php

declare(strict_types=1);

namespace App\Security\Voter;

use App\Entity\Blog;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BlogAccessVoter extends Voter
{
    public function __construct(private Security $security)
    {
    }

    /**
     * @param string $attribute
     * @param Blog $subject
     *
     * @return bool
     */
    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Blog &&
            \in_array($attribute, ['can_view_blog', 'can_edit_blog']);
    }

    protected function voteOnAttribute(
        string $attribute,
        mixed $subject,
        TokenInterface $token
    ): bool {
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }

        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return match ($attribute) {
            'can_edit_blog' => $this->canEditBlog($user, $subject),
            'can_view_blog' => $this->canViewBlog($user, $subject),
            default => throw new \LogicException('This code should not be executed')
        };
    }

    private function canEditBlog(User $user, Blog $blog): bool
    {
        return $blog->getAuthor() === $user;
    }

    private function canViewBlog(User $user, Blog $blog): bool
    {
        if ($this->canEditBlog($user, $blog)) {
            return true;
        }

        return  $blog->isDraft() === false;
    }
}
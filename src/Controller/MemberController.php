<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\RegisterMemberType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/member', name: "app_member_")]
class MemberController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function add(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $manager,
        MailerInterface $mailer,
        Security $security
    ): Response {
        $member = new User();
        $member->setRoles(['ROLE_MEMBER'])
            ->setConfirmed(false)
            ->setEnabled(false);

        $form = $this->createForm(RegisterMemberType::class, $member);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $randomPlainPassword = '';
            for ($i = 1; $i < 10; $i++) {
                $randomPlainPassword .= \rand(0, 9);
            }
            $member->setPassword($passwordHasher->hashPassword($member, $randomPlainPassword));

            $manager->persist($member);
            $manager->flush();

            $email = (new TemplatedEmail())->from('admin@system.com')
                ->to(new Address($member->getEmail(), $member->getFullName()))
                ->htmlTemplate('email/confirmation_email.html.twig')
                ->context([
                    'member' => $member,
                    'password' => $randomPlainPassword,
                ]);
            $mailer->send($email);

            return $this->redirectToRoute('app_member_add');
        }

        return $this->render('member/add.html.twig', [
            'register' => $form,
        ]);
    }

    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('member/profile.html.twig');
    }

    #[Route('/list', name: 'list')]
    public function manageSubscriptions(EntityManagerInterface $manager,): Response
    {
        /** @var User[] $repository */
        $users = $manager->getRepository(User::class)->findAll();

        return $this->render('member/manage.html.twig', ['subscriptions' => $users]);
    }
}

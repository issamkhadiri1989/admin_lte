<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\RegisterMemberType;
use App\Service\Member\SubscriptionHandler;
use App\Service\Member\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/member', name: "app_member_")]
class MemberController extends AbstractController
{
    #[Route('/add', name: 'add')]
    #[IsGranted("ROLE_MANAGER")]
    public function add(Request $request, SubscriptionHandler $handler, UserManager $userManager,): Response
    {
        $member = $userManager->createNewInstance();
        $form = $this->createForm(RegisterMemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $handler->handleSubscription($member);

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
    #[IsGranted("ROLE_MANAGER")]
    public function manageSubscriptions(EntityManagerInterface $manager,): Response
    {
        /** @var User[] $repository */
        $users = $manager->getRepository(User::class)->findAll();

        return $this->render('member/manage.html.twig', ['subscriptions' => $users]);
    }

    #[Route("/authorize/{id}", name: "confirm")]
    #[IsGranted("ROLE_MANAGER", exceptionCode: 403)]
    public function confirmSubscription(User $member, EntityManagerInterface $manager): Response
    {
        $member->setConfirmed(true);
        $manager->flush();

        return $this->redirectToRoute('app_member_list');
    }
}

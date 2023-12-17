<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Form\Type\BookType;
use App\Order\OrderCheckout;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    #[Route(path: "/checkout", name: "app_checkout")]
    public function purchase(OrderCheckout $checkout, Request $request): Response
    {
//        $builder = $this->createFormBuilder();
//        $builder->add('title', TextType::class)
//            ->add('synopsis', TextareaType::class)
//        ->add('add_book', SubmitType::class);
//
//        $form = $builder->getForm();

        $form = $this->createForm(BookType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // do some logic e.g persist in database
            $data = $form->getData();
            $this->manager->persist($data);
            $this->manager->flush();
            dd($data);
        }

        $checkout->checkout();

        return $this->render('checkout/checkout.html.twig', [
            'checkoutForm' => $form,
        ]);
    }
}
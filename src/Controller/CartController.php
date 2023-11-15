<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\BookType;
use App\Order\OrderCheckout;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route(path: "/checkout", name: "app_checkout")]
    public function purchase(OrderCheckout $checkout): Response
    {
//        $builder = $this->createFormBuilder();
//        $builder->add('title', TextType::class)
//            ->add('synopsis', TextareaType::class)
//        ->add('add_book', SubmitType::class);
//
//        $form = $builder->getForm();

        $form = $this->createForm(BookType::class);

        $checkout->checkout();

        return $this->render('checkout/checkout.html.twig', [
            'checkoutForm' => $form,
        ]);
    }
}
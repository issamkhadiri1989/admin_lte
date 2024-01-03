<?php

namespace App\Controller;

use App\Entity\VisaCard;
use App\Form\Type\VisaCardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment')]
    public function index(Request $request): Response
    {
        $card = new VisaCard();

        $form = $this->createForm(VisaCardType::class, $card);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($card);
        }

        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
            'form' => $form,
        ]);
    }
}

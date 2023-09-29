<?php

namespace App\Controller;

use App\Cart\Adapter\OrderToCartAdapter;
use App\Cart\Handle\CartHandlerInterface;
use App\Form\Type\CartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartHandlerInterface $handler, OrderToCartAdapter $adapter, Request $request): Response
    {
        $cart = $handler->getCart();

        $adaptedCart = $adapter->adapt($cart);

        $form = $this->createForm(CartType::class, $adaptedCart)
            ->add('update_cart', SubmitType::class, ['label' => 'Update cart'])
            ->add('place_order', SubmitType::class, ['label' => 'Place order']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('update_cart')->isClicked()) {
                // ... perform updating to the cart
                return $this->redirectToRoute('app_cart');
            }

            if ($form->get('place_order')->isClicked()) {
                // ... proceed to submission
                $handler->sendCart($adaptedCart);
                $this->addFlash('success', 'Your order is placed');

                return $this->redirectToRoute('app_cart');
            }
        }

        return $this->render('cart/index.html.twig', [
            'form' => $form,
            'cart' => $adaptedCart
        ]);
    }
}

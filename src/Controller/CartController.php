<?php

declare(strict_types=1);

namespace App\Controller;

use App\Order\OrderCheckout;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route(path: "/checkout", name: "app_checkout")]
    public function purchase(OrderCheckout $checkout): Response
    {
        $checkout->checkout();

        return new Response();
    }
}
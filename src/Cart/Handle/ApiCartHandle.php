<?php

declare(strict_types=1);

namespace App\Cart\Handle;

use App\Entity\Cart;
use App\ValueObject\Order;
use DateTimeImmutable;

class ApiCartHandle implements CartHandlerInterface
{
    public function getCart(): Order
    {
        // TODO : call the api to get the user's current cart.

        return new Order(new DateTimeImmutable());
    }

    public function persist(Order $order): Order
    {
        // TODO : call the api to persist the user's order.
        return $order;
    }

    public function empty(): void
    {
        // TODO: call the api to perform clearing the cart.
    }

    public function sendCart(Cart $order): void
    {
        // TODO: call the api to perform the transmission of the cart.
    }
}

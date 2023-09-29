<?php

namespace App\Cart\Handle;

use App\Entity\Cart;
use App\ValueObject\Order;

interface CartHandlerInterface
{
    /**
     * Get the order instance.
     *
     * @return Order
     */
    public function getCart(): Order;

    /**
     * Persists the order.
     *
     * @param Order $order
     *
     * @return Order
     */
    public function persist(Order $order): Order;

    /**
     * Clears the cart.
     *
     * @return void
     */
    public function empty(): void;

    /**
     * Saves the cart.
     *
     * @param Cart $order
     *
     * @return void
     */
    public function sendCart(Cart $order): void;
}

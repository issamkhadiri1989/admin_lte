<?php

declare(strict_types=1);

namespace App\Cart\Item;

use App\Cart\Handle\CartHandlerInterface;
use App\Entity\CartLine;
use App\ValueObject\Order;
use App\ValueObject\OrderLine;

class CartItemPersister
{
    public function __construct(private readonly CartHandlerInterface $handler)
    {
    }

    public function saveCartItem(CartLine $line): void
    {
        $cart = $this->handler->getCart();
        $this->doUpdateItemInCart($line, $cart);

        $this->handler->persist($cart);
    }

    private function doUpdateItemInCart(CartLine $line, Order $cart): void
    {
        $book = $line->getBook();
        if (!$cart->offsetExists($book->getId())) {
            $oldQuantity = 0;
        } else {
            /** @var OrderLine $item */
            $item = $cart->offsetGet($book->getId());
            $oldQuantity = $item->getQuantity();
        }
        $quantity = $oldQuantity + $line->getQuantity();

        $cart->addItem(new OrderLine($book->getId(), $quantity));
    }
}

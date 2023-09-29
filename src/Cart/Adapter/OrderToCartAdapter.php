<?php

declare(strict_types=1);

namespace App\Cart\Adapter;

use App\Entity\Book;
use App\Entity\Cart;
use App\Entity\CartLine;
use App\Repository\BookRepository;
use App\ValueObject\Order;
use App\ValueObject\OrderLine;
use Doctrine\ORM\EntityManagerInterface;

class OrderToCartAdapter
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {
    }

    public function adapt(Order $input): Cart
    {
        $cart = (new Cart())->setCreatedAt($input->getCreatedAt());
        $this->doAddCartLines($cart, $input);

        return $cart;
    }

    private function doAddCartLines(Cart $cart, Order $input): void
    {
        $bookIds = \array_keys($input->getItems());

        /** @var BookRepository $repository */
        $repository = $this->manager->getRepository(Book::class);

        $items = $repository->reloadCartItems($bookIds);

        foreach ($items as $book) {
            /** @var OrderLine $line */
            $line = $input->offsetGet($book->getId());
            $cart->addItem((new CartLine())
                ->setBook($book)
                ->setQuantity($line->getQuantity()));
        }
    }
}

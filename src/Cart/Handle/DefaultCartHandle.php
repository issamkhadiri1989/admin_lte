<?php

declare(strict_types=1);

namespace App\Cart\Handle;

use App\Entity\Cart;
use App\Enum\CartStatus;
use App\ValueObject\Order;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\HttpFoundation\RequestStack;

#[AsAlias]
class DefaultCartHandle implements CartHandlerInterface
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly EntityManagerInterface $manager,
        private readonly Security $security
    ) {
    }

    public function getCart(): Order
    {
        $session = $this->requestStack->getSession();
        if (!$session->has('cart')) {
            $order = new Order(new DateTimeImmutable());
            $session->set('cart', $order);
        } else {
            $order = $session->get('cart');
        }

        return $order;
    }

    public function sendCart(Cart $order): void
    {
        $order->setStatus(CartStatus::PLACED)
            ->setOwner($this->security->getUser());
        $this->manager->persist($order);

        $items = $order->getItems();
        foreach ($items as $line) {
            $this->manager->persist($line);
        }

        $this->manager->flush();
        // clear the cart
        $this->empty();
    }

    public function persist(Order $order): Order
    {
        $session = $this->requestStack->getSession();
        $session->set('cart', $order);

        return $order;
    }

    public function empty(): void
    {
        $this->requestStack
            ->getSession()
            ->remove('cart');
    }
}

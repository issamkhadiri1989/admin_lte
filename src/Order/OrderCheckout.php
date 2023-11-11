<?php

declare(strict_types=1);

namespace App\Order;

use App\Entity\Order;
use App\Order\Purchase\Purchaser\OrderPurchaserInterface;
use App\Service\Notify\MailNotifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class OrderCheckout
{
    public function __construct(private OrderPurchaserInterface $persister, private MailNotifier $notifier)
    {
    }

    public function checkout(Order $order): void
    {
        $this->persister->persist();

        $this->notifier->notify(
            new Address('khadiri.issam@gmail.com'),
            new Address($order->getCustomer()->getEmail())
        );
    }
}
<?php

declare(strict_types=1);

namespace App\Order;

use App\Order\Purchase\OrderPurchaserInterface;
use Symfony\Component\Mailer\MailerInterface;

class OrderCheckout
{
    private OrderPurchaserInterface $purchaser;
    private MailerInterface $mailer;

    public function __construct(OrderPurchaserInterface $purchaser, MailerInterface $mailer)
    {
        $this->purchaser = $purchaser;
        $this->mailer = $mailer;
    }

    public function checkout(): void
    {
        $this->purchaser->purchase();
//        $this->mailer->send();
    }
}
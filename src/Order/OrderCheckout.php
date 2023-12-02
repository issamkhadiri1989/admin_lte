<?php

declare(strict_types=1);

namespace App\Order;

use App\Order\Persister\AbstractOrderPersister;
use App\Order\Persister\DatabaseOrderPersister;
use App\Order\Persister\ExcelOrderPersister;
use App\Order\Persister\OrderPersister;
use App\Order\Persister\OrderPersisterInterface;
use Symfony\Component\Mailer\MailerInterface;

class OrderCheckout
{
    public function __construct(
		private MailerInterface $mailer, 
		private AbstractOrderPersister $persister, 
		private float $tax
	) {
    }

    public function checkout(): void
    {
        // ... logic to checkout
        $this->persister->persist();
        // ....
        $this->mailer->send(...);
    }
}
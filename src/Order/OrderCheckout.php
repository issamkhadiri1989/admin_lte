<?php

declare(strict_types=1);

namespace App\Order;

use App\Notifier\MailNotifier;
use App\Order\Persister\DatabaseOrderPersister;
use App\Order\Persister\ExcelOrderPersister;
use App\Order\Persister\PersisterInterface;

class OrderCheckout
{
    private MailNotifier $notifier;
    private PersisterInterface $persister;

    public function __construct(MailNotifier $notifier, PersisterInterface $excelPersister)
    {
        $this->notifier = $notifier;
        $this->persister = $excelPersister;
    }

    public function checkout(): void
    {
        $this->persister->persist();
        $this->notifier->notify();
    }
}
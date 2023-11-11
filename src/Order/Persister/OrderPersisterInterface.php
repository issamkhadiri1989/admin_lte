<?php

declare(strict_types=1);

namespace App\Order\Persister;

interface OrderPersisterInterface
{
    public function persist(): void;
}
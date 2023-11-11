<?php

declare(strict_types=1);

namespace App\Order\Persister;

use Doctrine\ORM\EntityManagerInterface;

class DatabaseOrderPersister extends AbstractOrderPersister
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    public function persist(): void
    {
        // ...
    }
}
<?php

declare(strict_types=1);

namespace App\Order\Persister;

abstract class AbstractOrderPersister
{
    abstract public function persist(): void;

    public function doSomething ()
    {
        echo "I did something";
    }
}
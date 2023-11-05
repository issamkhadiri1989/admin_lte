<?php

namespace App\Order\Persister;

interface PersisterInterface
{
    public function persist(): void;
}
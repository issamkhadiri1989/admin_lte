<?php

namespace App\Order\Purchase;

interface OrderPurchaserInterface
{
    public function purchase(): void;
}
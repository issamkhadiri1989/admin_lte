<?php

declare(strict_types=1);

namespace App\Entity;

class Product
{
    public function __construct(
        public string $label,
        public string $description,
        public float $price,
    ) {
    }
}
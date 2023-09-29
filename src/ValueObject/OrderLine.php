<?php

declare(strict_types=1);

namespace App\ValueObject;

class OrderLine
{
    private int $bookId;

    private int $quantity;

    public function __construct(int $bookId, int $quantity)
    {
        $this->bookId = $bookId;
        $this->quantity = $quantity;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}

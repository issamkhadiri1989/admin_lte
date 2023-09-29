<?php

declare(strict_types=1);

namespace App\ValueObject;

class Order implements \ArrayAccess
{
    private \DateTimeImmutable $createdAt;

    private array $items = [];

    public function __construct(\DateTimeImmutable $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function addItem(OrderLine $orderLine)
    {
        $this->offsetSet($orderLine->getBookId(), $orderLine);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->items[$offset] = $value;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function offsetGet(mixed $offset): mixed
    {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->items[$offset];
    }

    /**
     * @param mixed $offset The book id.
     *
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]) === true;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
        $this->items = \array_values($this->items);
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
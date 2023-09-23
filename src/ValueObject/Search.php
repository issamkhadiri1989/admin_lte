<?php

declare(strict_types=1);

namespace App\ValueObject;

final class Search
{
    private ?string $query;

    public function __construct(?string $query = null)
    {
        $this->query = $query;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(?string $query): void
    {
        $this->query = $query;
    }
}
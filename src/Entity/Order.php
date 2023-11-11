<?php

declare(strict_types=1);

namespace App\Entity;

class Order
{
    private Client $customer;

    /**
     * @return Client
     */
    public function getCustomer(): Client
    {
        return $this->customer;
    }

    /**
     * @param Client $customer
     */
    public function setCustomer(Client $customer): void
    {
        $this->customer = $customer;
    }

}
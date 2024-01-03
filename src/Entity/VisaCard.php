<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class VisaCard
{
    #[
        Assert\NotNull(),
        Assert\Regex('/^(\d+){4}\s(\d+){4}\s(\d+){4}\s(\d+){4}$/')
    ]
    private ?string $cardNumber;

    #[Assert\NotNull]
    private ?string $month;

    #[Assert\NotNull]
    private ?string $year;

    #[
        Assert\Length(3, exactMessage: 'This field should contain exactly 3 chars.'),
        Assert\NotNull(message: 'The CVV is mandatory'),
        Assert\Regex('/^(\d+){3}$/')
    ]
    private ?string $cvv;

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(?string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    public function getMonth(): ?string
    {
        return $this->month;
    }

    public function setMonth(?string $month): void
    {
        $this->month = $month;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): void
    {
        $this->year = $year;
    }

    public function getCvv(): ?string
    {
        return $this->cvv;
    }

    public function setCvv(?string $cvv): void
    {
        $this->cvv = $cvv;
    }
}

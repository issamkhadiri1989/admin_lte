<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PhoneConstraint extends Constraint
{
    public string $message = 'The phone number does not follow the pattern 99-9999-9999';
}
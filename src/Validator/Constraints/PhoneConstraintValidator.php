<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PhoneConstraintValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof PhoneConstraint) {
            return;
        }

        if (null  === $value || '' === $value) {
            return;
        }

        $pattern = '/^(\d){2}(\-(\d){4}){2}$/';

        if (\preg_match($pattern, $value) === 0) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
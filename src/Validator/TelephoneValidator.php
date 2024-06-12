<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TelephoneValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        // Remove any non-digit characters from the value
        $phoneNumber = preg_replace('/\D/', '', $value);

        // Check if the phone number starts with 0 and has exactly 10 digits
        if (strlen($phoneNumber) !== 10 || $phoneNumber[0] !== '0') {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}

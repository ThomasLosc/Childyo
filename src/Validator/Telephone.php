<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Telephone extends Constraint
{
    public $message = 'Le champ doit contenir exactement 10 chiffres et commencer par 0.';
}

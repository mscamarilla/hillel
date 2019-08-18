<?php

namespace App\Service;

use Symfony\Component\Validator\Constraint;

class ObsceneWords extends Constraint
{
    public $message = 'Be polite! No obscene words!';
}

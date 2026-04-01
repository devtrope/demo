<?php

namespace App\Rules;

use Ludens\Validation\Contracts\RuleInterface;

class MinWords implements RuleInterface
{
    public function validate(mixed $value): bool
    {
        $words = explode(' ', $value);
        return \sizeof($words) >= 3;
    }

    public function message(string $field): string
    {
        return "La description doit comporter au moins 3 mots";
    }
}

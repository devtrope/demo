<?php

namespace App\Rules;

use Ludens\Validation\AbstractRule;
use Ludens\Validation\Contracts\RuleInterface;

class MinWords extends AbstractRule implements RuleInterface
{
    public function validate(mixed $value): bool
    {
        $words = explode(' ', $value);
        return \sizeof($words) >= 3;
    }

    public function message(string $field): string
    {
        return $this->getTranslator()->get('validation.min_words', [
            'field' => $field,
            'words' => 3
        ]);
    }
}

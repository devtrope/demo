<?php

namespace App\Rules;

use Ludens\Translation\Translator;
use Ludens\Validation\Contracts\RuleInterface;

class MinWords implements RuleInterface
{
    public function __construct(
        private Translator $translator = new Translator()
    ) {
    }

    public function validate(mixed $value): bool
    {
        $words = explode(' ', $value);
        return \sizeof($words) >= 3;
    }

    public function message(string $field): string
    {
        return $this->translator->get('validation.min_words', [
            'field' => $field,
            'words' => 3
        ]);
    }
}

<?php

namespace App\View\Extensions;

use Ludens\Framework\View\Contracts\TwigFilterInterface;

class StrPadFilter implements TwigFilterInterface
{
    public function name(): string
    {
        return 'str_pad';
    }

    public function execute(): callable
    {
        return function (string $text, int $padLength, string $padString) {
            return str_pad($text, $padLength, $padString, STR_PAD_LEFT);
        };
    }

    public function options(): array
    {
        return [];
    }
}

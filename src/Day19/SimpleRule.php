<?php

declare(strict_types=1);

namespace AdventOfCode\Day19;

class SimpleRule implements Rule
{
    public function __construct(private string $value)
    {
    }

    public function isValid(string $string, int &$index = 0): bool
    {
        var_dump(['index' => $index, 'value' => $this->value]);

        return $string[$index] === $this->value;
    }

    public function asString(int $deep): string
    {
        return $this->value;
    }
}

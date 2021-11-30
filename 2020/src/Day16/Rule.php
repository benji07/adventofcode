<?php

declare(strict_types=1);

namespace AdventOfCode\Day16;

class Rule
{
    public function __construct(
        public string $name,
        public int $min1,
        public int $max1,
        public int $min2,
        public int $max2
    ) {
    }

    public static function createFromString(string $rule): self
    {
        [$name, $rules] = explode(':', $rule);

        return new self($name, ...(array) sscanf($rules, '%d-%d or %d-%d'));
    }

    public function isValid(int $value): bool
    {
        return ($value >= $this->min1 && $value <= $this->max1) || ($value >= $this->min2 && $value <= $this->max2);
    }
}

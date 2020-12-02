<?php

namespace AdventOfCode\Day2;

class Rule
{
    public function __construct(
        public int $min,
        public int $max,
        public string $letter,
    ) {}

    public function isValid(string $password): bool
    {
        $found = substr_count($password, $this->letter);

        return $found >= $this->min && $found <= $this->max;
    }
}

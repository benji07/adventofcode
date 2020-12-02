<?php

namespace AdventOfCode\Day2;

class RuleV2
{
    public function __construct(
        public int $min,
        public int $max,
        public string $letter,
    ) {}

    public function isValid(string $password): bool
    {
        return $password[$this->min - 1] === $this->letter xor $password[$this->max - 1] === $this->letter;
    }
}

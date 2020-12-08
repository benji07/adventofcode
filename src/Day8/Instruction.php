<?php

namespace AdventOfCode\Day8;

class Instruction
{
    public function __construct(public string $type, public int $value) { }

    public function __toString(): string
    {
        return sprintf("%s %+d", $this->type, $this->value);
    }
}

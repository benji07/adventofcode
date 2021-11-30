<?php

declare(strict_types=1);

namespace AdventOfCode\Day19;

interface Rule
{
    public function isValid(string $string, int &$index = 0): bool;

    public function asString(int $deep): string;
}

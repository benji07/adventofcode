<?php

declare(strict_types=1);

namespace AdventOfCode\Day2;

interface RuleInterface
{
    public function isValid(string $password): bool;
}

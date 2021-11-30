<?php

declare(strict_types=1);

namespace AdventOfCode\Day2;

interface RuleFactoryInterface
{
    public function create(int $min, int $max, string $letter): RuleInterface;
}

<?php

namespace AdventOfCode\Day2;

interface RuleFactoryInterface
{
    public function create(int $min, int $max, string $letter): RuleInterface;
}

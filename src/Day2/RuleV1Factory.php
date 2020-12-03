<?php

namespace AdventOfCode\Day2;

class RuleV1Factory implements RuleFactoryInterface
{
    public function create(int $min, int $max, string $letter): RuleInterface
    {
        return new RuleV1($min, $max, $letter);
    }
}

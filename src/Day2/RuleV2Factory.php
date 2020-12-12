<?php

declare(strict_types=1);

namespace AdventOfCode\Day2;

class RuleV2Factory implements RuleFactoryInterface
{
    public function create(int $min, int $max, string $letter): RuleInterface
    {
        return new RuleV2($min, $max, $letter);
    }
}

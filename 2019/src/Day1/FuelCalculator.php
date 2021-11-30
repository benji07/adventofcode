<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day1;

class FuelCalculator
{
    public function compute(int $mass): int
    {
        return (int) (floor($mass / 3) - 2);
    }
}

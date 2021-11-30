<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day1;

class FuelCalculatorV2 extends FuelCalculator
{
    public function compute(int $mass): int
    {
        $initialFullNeeded = (int) (floor($mass / 3) - 2);

        if ($initialFullNeeded <= 0) {
            return 0;
        }

        return $initialFullNeeded + $this->compute($initialFullNeeded);
    }
}

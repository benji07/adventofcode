<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day1;

class Runner
{
    private FuelCalculator $fuelCalculator;

    public function __construct(FuelCalculator $fuelCalculator)
    {
        $this->fuelCalculator = $fuelCalculator;
    }

    /**
     * @param int[] $masses
     */
    public function run(array $masses): int
    {
        $fullNeeded = 0;

        foreach ($masses as $mass) {
            $fullNeeded += $this->fuelCalculator->compute((int) $mass);
        }

        return $fullNeeded;
    }
}

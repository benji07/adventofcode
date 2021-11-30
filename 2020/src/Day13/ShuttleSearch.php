<?php

declare(strict_types=1);

namespace AdventOfCode\Day13;

class ShuttleSearch
{
    /**
     * ShuttleSearch constructor.
     *
     * @param int[] $buses
     */
    public function __construct(public array $buses)
    {
    }

    public function search(int $timestamp): int
    {
        $min = $timestamp;
        $found = 0;
        foreach ($this->buses as $bus) {
            $diff = ceil($timestamp / $bus) * $bus - $timestamp;
            if ($diff < $min) {
                $min = $diff;
                $found = $bus;
            }
        }

        return (int) ($found * $min);
    }

    public function getEarliestTime(): int
    {
        $earliestTime = 0;
        $runningProduct = 1;

        foreach ($this->buses as $index => $id) {
            while (($earliestTime + $index) % $id !== 0) {
                $earliestTime += $runningProduct;
            }

            $runningProduct *= $id;
        }

        return $earliestTime;
    }
}

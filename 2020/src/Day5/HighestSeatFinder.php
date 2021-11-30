<?php

declare(strict_types=1);

namespace AdventOfCode\Day5;

class HighestSeatFinder
{
    public function find(BoardingPass ...$boardingPasses): int
    {
        return array_reduce(
            $boardingPasses,
            fn ($max, BoardingPass $boardingPass) => max($max, $boardingPass->seatID),
            0
        );
    }
}

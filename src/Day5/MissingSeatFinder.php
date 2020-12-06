<?php

namespace AdventOfCode\Day5;

class MissingSeatFinder
{
    public function find(BoardingPass ...$boardingPasses): int
    {
        $ids = array_map(fn(BoardingPass $boardingPass) => $boardingPass->seatID, $boardingPasses);

        return (int) current(array_diff(range(min(...$ids), max(...$ids)), $ids));
    }
}

<?php

namespace AdventOfCode\Day5;

class MissingSeatFinder
{
    public function find(BoardingPass ...$boardingPasses): int|null
    {
        $ids = array_map(fn(BoardingPass $boardingPass) => $boardingPass->seatID, $boardingPasses);

        $minId = min(...$ids);
        $maxId = max(...$ids);

        for ($i = $minId; $i < $maxId; $i++) {
            if (in_array($i - 1, $ids, true) && in_array($i + 1, $ids, true) && !in_array($i, $ids, true)) {
                return $i;
            }
        }

        return null;
    }
}

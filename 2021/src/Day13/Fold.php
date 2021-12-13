<?php

declare(strict_types=1);

namespace AOC2021\Day13;

use AOC2021\Day05\Point;

class Fold
{
    public function __construct(
        public string $direction,
        public int $position
    ) {
    }

    public function apply(Point $point): Point
    {
        $newPoint = clone $point;

        if ($newPoint->{$this->direction} < $this->position) {
            return $newPoint;
        }

        $newPoint->{$this->direction} = $newPoint->{$this->direction} - ($newPoint->{$this->direction} - $this->position) * 2;

        return $newPoint;
    }
}

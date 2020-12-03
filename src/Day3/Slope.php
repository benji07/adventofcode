<?php

namespace AdventOfCode\Day3;

class Slope
{
    public function __construct(
        public int $right,
        public int $down,
    ) {}

    public function move(Point $point): Point
    {
        return new Point($point->x + $this->right, $point->y + $this->down);
    }
}

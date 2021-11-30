<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day3;

class Point
{
    public int $x;

    public int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function __toString()
    {
        return $this->x . ';' . $this->y;
    }

    public function getDistance(): int
    {
        return abs($this->x) + abs($this->y);
    }
}

<?php

namespace Benji07\AdventOfCode\Day12;

class Position
{
    public int $x;

    public int $y;

    public int $z;

    public function __construct(int $x, int $y, int $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function __toString()
    {
        return "[{$this->x},{$this->y},{$this->z}]";
    }
}

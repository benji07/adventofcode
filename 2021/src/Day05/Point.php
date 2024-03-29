<?php

declare(strict_types=1);

namespace AOC2021\Day05;

class Point
{
    public function __construct(
        public int $x,
        public int $y,
    ) {
    }

    public function __toString(): string
    {
        return "$this->x;$this->y";
    }
}

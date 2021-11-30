<?php

declare(strict_types=1);

namespace AdventOfCode\Day17;

class Cube
{
    public function __construct(public int $x, public int $y, public int $z, public bool $active = true)
    {
    }

    public function __toString(): string
    {
        return $this->x . ';' . $this->y . ';' . $this->z;
    }

    public function isNeighbors(Cube $cube): bool
    {
        return
            ($this->x - 1 === $cube->x || $this->x === $cube->x || $this->x + 1 === $cube->x)
            && ($this->y - 1 === $cube->y || $this->y === $cube->y || $this->y + 1 === $cube->y)
            && ($this->z - 1 === $cube->z || $this->z === $cube->z || $this->z + 1 === $cube->z);
    }
}

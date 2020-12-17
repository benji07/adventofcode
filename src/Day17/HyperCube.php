<?php

declare(strict_types=1);

namespace AdventOfCode\Day17;

class HyperCube extends Cube
{
    public function __construct(int $x, int $y, int $z, public int $w, public bool $active = true)
    {
        parent::__construct($x, $y, $z, $this->active);
    }

    public function __toString(): string
    {
        return $this->x . ';' . $this->y . ';' . $this->z . ';' . $this->w;
    }

    public function isNeighbors(Cube $cube): bool
    {
        if (!$cube instanceof HyperCube) {
            throw new \RuntimeException('Only HyperCube supported');
        }

        return parent::isNeighbors($cube)
            && ($this->w - 1 === $cube->w || $this->w === $cube->w || $this->w + 1 === $cube->w);
    }
}

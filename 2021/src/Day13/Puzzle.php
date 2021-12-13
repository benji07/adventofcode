<?php

declare(strict_types=1);

namespace AOC2021\Day13;

use AOC2021\Day05\Point;

class Puzzle
{
    public function __construct(
        /** @var Point[] */
        public array $points
    ) {
    }

    public function fold(Fold $fold): void
    {
        $points = [];
        foreach ($this->points as $point) {
            $newPoint = $fold->apply($point);
            $points[(string) $newPoint] = $newPoint;
        }

        $this->points = $points;
    }

    public function __toString(): string
    {
        $maxX = max(array_map(fn (Point $point) => $point->x, $this->points));
        $maxY = max(array_map(fn (Point $point) => $point->y, $this->points));

        $points = [];
        foreach ($this->points as $point) {
            $points[$point->y][$point->x] = true;
        }

        $string = '';

        for ($y = 0; $y <= $maxY; ++$y) {
            for ($x = 0; $x <= $maxX; ++$x) {
                $string .= isset($points[$y][$x]) ? '#' : '.';
            }

            $string .= "\n";
        }

        return trim($string);
    }
}

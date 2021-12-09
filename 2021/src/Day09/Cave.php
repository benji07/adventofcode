<?php

declare(strict_types=1);

namespace AOC2021\Day09;

use AOC2021\Day05\Point;

class Cave
{
    public function __construct(
        /** @var int[][] */
        public array $map
    ) {
    }

    /**
     * @return Point[]
     */
    public function getNeighbors(Point $point): array
    {
        $x = $point->x;
        $y = $point->y;

        return array_filter([
            'up' => isset($this->map[$y - 1][$x]) ? new Point($x, $y - 1) : null,
            'left' => isset($this->map[$y][$x - 1]) ? new Point($x - 1, $y) : null,
            'right' => isset($this->map[$y][$x + 1]) ? new Point($x + 1, $y) : null,
            'down' => isset($this->map[$y + 1][$x]) ? new Point($x, $y + 1) : null,
        ], fn ($value) => $value !== null);
    }

    /**
     * @return int[]
     */
    public function getNeighborsAsValue(Point $point): array
    {
        return array_map(fn (Point $point) => $this->getValue($point), $this->getNeighbors($point));
    }

    /**
     * @return Point[]
     */
    public function findLowPoints(): array
    {
        $lowPoints = [];
        foreach ($this->map as $y => $row) {
            foreach ($row as $x => $value) {
                $point = new Point($x, $y);
                if ($value < min($this->getNeighborsAsValue($point))) {
                    $lowPoints[] = $point;
                }
            }
        }

        return $lowPoints;
    }

    public function getValue(Point $point): int
    {
        return $this->map[$point->y][$point->x];
    }

    /**
     * @return Point[]
     */
    public function getBasin(Point $point): array
    {
        static $points = [];
        $basin = [];

        $neighbors = $this->getNeighbors($point);
        foreach ($neighbors as $neighbor) {
            if ($this->getValue($neighbor) === 9) {
                continue;
            }

            if (\in_array($neighbor, $points)) {
                continue;
            }

            $points[] = $neighbor;
            $basin[] = $neighbor;

            $basin = array_merge($basin, $this->getBasin($neighbor));
        }

        return $basin;
    }
}

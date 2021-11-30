<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day3;

class Grid
{
    /** @var Point[][] */
    private array $grid = [];

    private array $intersection = [];

    public function addWire(int $id, array $wire): void
    {
        $initial = $position = ['x' => 0, 'y' => 0];
        foreach ($wire as $move) {
            $quantity = (int) substr($move, 1);

            switch ($move[0]) {
                case 'U':
                    $initial['y']--;
                    $position['y'] -= $quantity;
                    break;
                case 'D':
                    $initial['y']++;
                    $position['y'] += $quantity;
                    break;
                case 'R':
                    $initial['x']++;
                    $position['x'] += $quantity;
                    break;
                case 'L':
                    $initial['x']--;
                    $position['x'] -= $quantity;
                    break;
            }

            // fill
            foreach (range($initial['x'], $position['x']) as $x) {
                foreach (range($initial['y'], $position['y']) as $y) {
                    $this->grid[$id][] = new Point($x, $y);
                }
            }

            $initial = $position;
        }
    }

    public function getGrid(): array
    {
        return $this->grid;
    }

    /**
     * @return Point[]
     */
    public function getIntersections(): array
    {
        $initial = current($this->grid);
        $compare = next($this->grid);

        return array_values(array_intersect($initial, $compare));
    }

    public function getManhattanDistance(): int
    {
        $intersections = $this->getIntersections();

        if (count($intersections) === 0) {
            throw new \DomainException('No intersection found');
        }

        $distance = null;
        foreach ($intersections as $intersection) {
            $currentDistance = $intersection->getDistance();

            if ($distance === null) {
                $distance = $currentDistance;
            }

            $distance = (int) min($distance, $currentDistance);
        }

        return $distance;
    }

    public function getSteps(Point $point): int
    {
        return (int) array_sum(
            array_map(static function (array $wire) use ($point): int {
                return (int) array_search($point, $wire, false) + 1;
            }, $this->grid)
        );
    }

    public function getLowestSteps(): int
    {
        return (int) min(
            array_map(function (Point $point) {
                return $this->getSteps($point);
            }, $this->getIntersections())
        );
    }
}

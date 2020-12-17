<?php

declare(strict_types=1);

namespace AdventOfCode\Day17;

class PocketDimension
{
    final public function __construct(
        /* @param Cube[] */
        public array $cubes
    ) {
    }

    public static function createFromString(string $input): self
    {
        $cubes = [];
        $rows = explode("\n", $input);

        foreach ($rows as $y => $row) {
            foreach (str_split($row) as $x => $cell) {
                if ($cell === '#') {
                    $cube = new Cube($x, $y, 1);
                    $cubes[(string) $cube] = $cube;
                }
            }
        }

        return new self($cubes);
    }

    public function cycleNTimes(int $times): PocketDimension
    {
        if ($times === 0) {
            return $this;
        }

        $dimension = $this->cycle();

        return $dimension->cycleNTimes($times - 1);
    }

    public function cycle(): PocketDimension
    {
        $newCubes = [];
        $processed = [];

        foreach ($this->cubes as $cube) {
            $neighbors = $this->getNeighbors($cube);

            foreach ($neighbors as $neighbor) {
                if (\in_array((string) $neighbor, $processed, true)) {
                    continue;
                }
                $activeNeighbors = $this->countActiveNeighbors($neighbor);

                if ($neighbor->active && \in_array($activeNeighbors, [2, 3], true)) {
                    // If a cube is active and exactly 2 or 3 of its neighbors are also active, the cube remains active.
                    $newCubes[(string) $neighbor] = $neighbor;
                } elseif (!$neighbor->active && $activeNeighbors === 3) {
                    // If a cube is inactive but exactly 3 of its neighbors are active, the cube becomes active.
                    $neighbor->active = true;

                    $newCubes[(string) $neighbor] = $neighbor;
                }

                $processed[] = (string) $neighbor;
            }
        }

        return new static($newCubes);
    }

    public function countActiveNeighbors(Cube $cube): int
    {
        return \count(array_filter($this->getNeighbors($cube), fn (Cube $possible) => $possible->active));
    }

    /**
     * @return Cube[]
     */
    public function getNeighbors(Cube $cube): array
    {
        $cubes = [];
        for ($x = $cube->x - 1; $x <= $cube->x + 1; ++$x) {
            for ($y = $cube->y - 1; $y <= $cube->y + 1; ++$y) {
                for ($z = $cube->z - 1; $z <= $cube->z + 1; ++$z) {
                    $c = new Cube($x, $y, $z, false);

                    $cubes[] = $this->cubes[(string) $c] ?? $c;
                }
            }
        }

        return array_filter($cubes, fn (Cube $neighbor): bool => (string) $neighbor !== (string) $cube);
    }

    public function count(): int
    {
        return \count($this->cubes);
    }
}

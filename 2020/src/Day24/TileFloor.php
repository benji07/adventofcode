<?php

declare(strict_types=1);

namespace AdventOfCode\Day24;

class TileFloor
{
    /** @var Coordinate[] */
    public array $tiles = [];

    public function renovate(array $instructions): void
    {
        $tilesToUpdate = array_map(
            fn (string $instruction): Coordinate => Coordinate::fromInput($instruction),
            $instructions
        );

        foreach ($tilesToUpdate as $tile) {
            if (\array_key_exists((string) $tile, $this->tiles)) {
                unset($this->tiles[(string) $tile]);
            } else {
                $this->tiles[(string) $tile] = $tile;
            }
        }
    }

    public function flip(): void
    {
        $result = [];
        $visited = [];
        foreach ($this->tiles as $tile) {
            foreach ($tile->getNeighbors() as $hash => $neighbor) {
                if (\array_key_exists($hash, $visited)) {
                    continue;
                }

                $visited[$hash] = true;

                $neighbors = $neighbor->getNeighbors();
                $blackNeighbors = \count(array_intersect_key($neighbors, $this->tiles));

                if (\array_key_exists((string) $neighbor, $this->tiles)) {
                    // black with 1 or 2 black neighbors
                    if (\in_array($blackNeighbors, [1, 2], true)) {
                        $result[$hash] = $neighbor;
                    }
                } else {
                    // white with 2 black neighbors
                    if ($blackNeighbors === 2) {
                        $result[$hash] = $neighbor;
                    }
                }
            }
        }

        $this->tiles = $result;
    }
}

<?php

declare(strict_types=1);

namespace AdventOfCode\Day17;

class PocketDimension4 extends PocketDimension
{
    public static function createFromString(string $input): self
    {
        $cubes = [];
        $rows = explode("\n", $input);

        foreach ($rows as $y => $row) {
            foreach (str_split($row) as $x => $cell) {
                if ($cell === '#') {
                    $cube = new HyperCube($x, $y, 1, 1);
                    $cubes[(string) $cube] = $cube;
                }
            }
        }

        return new self($cubes);
    }

    /**
     * @return Cube[]
     */
    public function getNeighbors(Cube $cube): array
    {
        if (!$cube instanceof HyperCube) {
            throw new \RuntimeException('Only HyperCube supported');
        }

        $cubes = [];
        for ($x = $cube->x - 1; $x <= $cube->x + 1; ++$x) {
            for ($y = $cube->y - 1; $y <= $cube->y + 1; ++$y) {
                for ($z = $cube->z - 1; $z <= $cube->z + 1; ++$z) {
                    for ($w = $cube->w - 1; $w <= $cube->w + 1; ++$w) {
                        $c = new HyperCube($x, $y, $z, $w, false);

                        $cubes[] = $this->cubes[(string) $c] ?? $c;
                    }
                }
            }
        }

        return array_filter($cubes, fn (Cube $neighbor): bool => (string) $neighbor !== (string) $cube);
    }
}

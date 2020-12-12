<?php

declare(strict_types=1);

namespace AdventOfCode\Day11;

class SeatingSystem
{
    const FLOOR = '.';
    const EMPTY = 'L';
    const OCCUPIED = '#';

    /** @var string[][] */
    private array $floorPlan;
    private int $width;
    private int $height;

    public function __construct(string $floorPlan)
    {
        $this->floorPlan = array_map(fn (string $row): array => str_split($row), explode("\n", trim($floorPlan)));
        $this->width = \count(current($this->floorPlan));
        $this->height = \count($this->floorPlan);
    }

    public function get(int $x, int $y): ?string
    {
        return $this->floorPlan[$y][$x] ?? null;
    }

    public function countOccupiedAdjacentCell(int $x, int $y, bool $breakOnFirst = true): int
    {
        return \count(array_filter([
            $this->findOccupiedSeat($x, $y, new Vector(-1, -1), $breakOnFirst),
            $this->findOccupiedSeat($x, $y, new Vector(0, -1), $breakOnFirst),
            $this->findOccupiedSeat($x, $y, new Vector(+1, -1), $breakOnFirst),
            $this->findOccupiedSeat($x, $y, new Vector(-1, 0), $breakOnFirst),
            $this->findOccupiedSeat($x, $y, new Vector(+1, 0), $breakOnFirst),
            $this->findOccupiedSeat($x, $y, new Vector(-1, +1), $breakOnFirst),
            $this->findOccupiedSeat($x, $y, new Vector(0, +1), $breakOnFirst),
            $this->findOccupiedSeat($x, $y, new Vector(+1, +1), $breakOnFirst),
        ]));
    }

    public function findOccupiedSeat(int $x, int $y, Vector $vector, bool $breakOnFirst = true): bool
    {
        do {
            $x += $vector->x;
            $y += $vector->y;

            if ($breakOnFirst) {
                break;
            }
        } while ($this->get($x, $y) === self::FLOOR);

        return $this->get($x, $y) === self::OCCUPIED;
    }

    public function fill(bool $breakOnFirst = true, int $maxOccupiedCell = 4): bool
    {
        $changed = false;
        $newFloorPlan = [];
        foreach ($this->floorPlan as $y => $row) {
            foreach ($row as $x => $cell) {
                if ($cell === self::FLOOR) {
                    $newFloorPlan[$y][$x] = self::FLOOR;
                    continue;
                }

                $countOccupiedAdjacentCell = $this->countOccupiedAdjacentCell($x, $y, $breakOnFirst);
                if ($countOccupiedAdjacentCell === 0 && $this->floorPlan[$y][$x] !== self::OCCUPIED) {
                    $changed = true;
                    $newFloorPlan[$y][$x] = self::OCCUPIED;
                } elseif ($countOccupiedAdjacentCell >= $maxOccupiedCell && $this->floorPlan[$y][$x] !== self::EMPTY) {
                    $changed = true;
                    $newFloorPlan[$y][$x] = self::EMPTY;
                } else {
                    $newFloorPlan[$y][$x] = $cell;
                }
            }
        }

        $this->floorPlan = $newFloorPlan;

        return $changed;
    }

    public function resolve(bool $breakOnFirst = true, int $maxOccupiedCell = 4): void
    {
        do {
            $changed = $this->fill($breakOnFirst, $maxOccupiedCell);
        } while ($changed);
    }

    public function countOccupiedSeats(): int
    {
        return (int) count_chars((string) $this, 1)[\ord(self::OCCUPIED)] ?? 0;
    }

    public function __toString(): string
    {
        return implode("\n", array_map(fn (array $row): string => implode('', $row), $this->floorPlan));
    }
}

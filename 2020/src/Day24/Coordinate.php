<?php

declare(strict_types=1);

namespace AdventOfCode\Day24;

class Coordinate
{
    public const EAST = 'e';
    public const SOUTHEAST = 'se';
    public const SOUTHWEST = 'sw';
    public const WEST = 'w';
    public const NORTHWEST = 'nw';
    public const NORTHEAST = 'ne';

    public function __construct(public int $x, public int $y, public int $z)
    {
    }

    public static function fromInput(string $input): self
    {
        $parser = new Parser();
        $directions = $parser->parse($input);

        $reference = new self(0, 0, 0);

        foreach ($directions as $direction) {
            $reference = $reference->move($direction);
        }

        return $reference;
    }

    public function __toString(): string
    {
        return implode(';', [$this->x, $this->y, $this->z]);
    }

    public function move(string $direction): self
    {
        [$x, $y, $z] = match ($direction) {
            self::EAST => [1, -1, 0],
            self::SOUTHEAST => [1, 0, -1],
            self::SOUTHWEST => [0, 1, -1],
            self::WEST => [-1, 1, 0],
            self::NORTHWEST => [-1, 0, 1],
            self::NORTHEAST => [0, -1, 1],
            default => new \Exception('Invalid direction')
        };

        return new Coordinate($this->x + $x, $this->y + $y, $this->z + $z);
    }

    public function getNeighbors(): array
    {
        $neighbors = [
            $this->move(Coordinate::EAST),
            $this->move(Coordinate::SOUTHEAST),
            $this->move(Coordinate::SOUTHWEST),
            $this->move(Coordinate::WEST),
            $this->move(Coordinate::NORTHWEST),
            $this->move(Coordinate::NORTHEAST),
        ];

        return array_combine(array_map('strval', $neighbors), $neighbors);
    }
}

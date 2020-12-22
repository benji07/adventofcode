<?php

declare(strict_types=1);

namespace AdventOfCode\Day20;

class Tile
{
    const EDGE_TOP = 'edge_top';// en fonction
    const EDGE_BOTTOM = 'edge_bottom';// en fonction
    const EDGE_LEFT = 'edge_left';// en fonction
    const EDGE_RIGHT = 'edge_right';// en fonction
    const EDGE_MIRROR_TOP = 'edge_mirror_top';// en fonction
    const EDGE_MIRROR_BOTTOM = 'edge_mirror_bottom';// en fonction
    const EDGE_MIRROR_LEFT = 'edge_mirror_left';// en fonction
    const EDGE_MIRROR_RIGHT = 'edge_mirror_right';

    public function __construct(public int $id, public array $image)
    {
    }

    public function getEdges(bool $mirrored = false): array
    {
        $firstRow = implode('', reset($this->image));
        $lastRow = implode('', end($this->image));
        $firstColumn = implode('', array_column($this->image, 0));
        $lastColumn = implode('', array_column($this->image, \count($this->image) - 1));

        $edges = [
            self::EDGE_TOP => $firstRow,
            self::EDGE_BOTTOM => $lastRow,
            self::EDGE_LEFT => $firstColumn,
            self::EDGE_RIGHT => $lastColumn,
        ];

        if ($mirrored) {
            $edges = array_merge($edges, [
                self::EDGE_MIRROR_TOP => strrev($firstRow),
                self::EDGE_MIRROR_BOTTOM => strrev($lastRow),
                self::EDGE_MIRROR_LEFT => strrev($firstColumn),
                self::EDGE_MIRROR_RIGHT => strrev($lastColumn),
            ]);
        }

        return $edges;
    }

    public function __toString(): string
    {
        return sprintf(
            "Tile %d:\n%s",
            $this->id,
            implode("\n", array_map(fn($row) => implode('', $row), $this->image))
        );
    }

    public function transform(string $sourceEdge)
    {
        return match ($sourceEdge) {
            self::EDGE_MIRROR_TOP, self::EDGE_MIRROR_BOTTOM => new self($this->id, array_map(fn (array $row) => array_reverse($row), $this->image)),
            self::EDGE_MIRROR_LEFT, self::EDGE_MIRROR_RIGHT => new self($this->id, array_reverse($this->image)),
        };
    }
}

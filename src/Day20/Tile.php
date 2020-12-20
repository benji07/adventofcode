<?php

namespace AdventOfCode\Day20;

class Tile
{
    public function __construct(public int $id, public array $image)
    {
    }


    public function getEdges(bool $mirrored = false): array
    {
        $firstRow = implode('', reset($this->image));
        $lastRow = implode('', end($this->image));
        $firstColumn = implode('', array_column($this->image, 0));
        $lastColumn = implode('', array_column($this->image, count($this->image) - 1));

        $edges = [
            $firstRow,
            $lastRow,
            $firstColumn,
            $lastColumn,
        ];

        if ($mirrored) {
            $edges = array_merge($edges, [
                strrev($firstRow),
                strrev($lastRow),
                strrev($firstColumn),
                strrev($lastColumn)
            ]);
        }

        return $edges;
    }
}

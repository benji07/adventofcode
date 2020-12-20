<?php

namespace AdventOfCode\Day20;

class EdgeFinder
{
    public function find(Tile ...$tiles): array
    {
        $matches = [];
        foreach ($tiles as $tile) {
            $matches[$tile->id] = $this->findMatches($tile, array_filter($tiles, fn (Tile $t) => $t->id !== $tile->id));
        }

        return array_keys(array_filter($matches, fn ($tiles) => count($tiles) == 2));
    }

    /**
     * @param Tile[] $tiles
     *
     * @return Tile[]
     */
    protected function findMatches(Tile $tile, array $tiles): array
    {
        $result = [];
        foreach ($tiles as $search) {
            foreach ($tile->getEdges(true) as $edge) {
                if (in_array($edge, $search->getEdges(), true)) {
                    $result[] = $search;
                }
            }
        }

        return $result;
    }
}

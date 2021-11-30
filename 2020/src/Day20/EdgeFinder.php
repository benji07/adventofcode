<?php

declare(strict_types=1);

namespace AdventOfCode\Day20;

class EdgeFinder
{
    public function find(Tile ...$tiles): array
    {
        $matches = [];
        foreach ($tiles as $tile) {
            $matches[$tile->id] = $this->findMatches($tile, array_filter($tiles, fn (Tile $t) => $t->id !== $tile->id));
        }

        return array_filter($matches, fn ($tiles) => \count($tiles) == 2);
    }

    /**
     * @param Tile[] $tiles
     *
     * @return TileMatch[]
     */
    public function findMatches(Tile $tile, array $tiles): array
    {
        $result = [];
        foreach ($tiles as $search) {
            foreach ($tile->getEdges(true) as $sourceEdge => $edge) {
                if ($destinationEdge = array_search($edge, $search->getEdges(), true)) {
                    $result[] = new TileMatch($tile, $search, $sourceEdge, $destinationEdge);
                }
            }
        }

        return $result;
    }
}

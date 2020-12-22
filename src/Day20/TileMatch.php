<?php

namespace AdventOfCode\Day20;

class TileMatch
{
    public function __construct(
        public Tile $source,
        public Tile $neighbor,
        public string $sourceEdge,
        public string $neighborEdge
    ) {
    }

    public function __toString(): string
    {
        return sprintf(
            "Source: %s\nDestination: %s\n %s %s",
            $this->source,
            $this->neighbor,
            $this->sourceEdge,
            $this->neighborEdge
        );
    }

    public function getRelativeCoordinates(): array
    {
        return match($this->sourceEdge) {
            Tile::EDGE_TOP, Tile::EDGE_MIRROR_TOP => [0, -1],
            Tile::EDGE_BOTTOM, Tile::EDGE_MIRROR_BOTTOM => [0, 1],
            Tile::EDGE_LEFT, Tile::EDGE_MIRROR_LEFT => [-1, 0],
            Tile::EDGE_RIGHT, Tile::EDGE_MIRROR_RIGHT => [1, 0],
        };
    }

    public function getTransformedNeighbor(): Tile
    {
        return match($this->sourceEdge) {
            Tile::EDGE_MIRROR_RIGHT, Tile::EDGE_MIRROR_LEFT, Tile::EDGE_MIRROR_BOTTOM, Tile::EDGE_MIRROR_TOP => $this->neighbor->transform($this->sourceEdge),
            default => $this->neighbor,
        };
    }
}

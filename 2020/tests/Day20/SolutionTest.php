<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day20;

use AdventOfCode\Day20\EdgeFinder;
use AdventOfCode\Day20\Parser;
use AdventOfCode\Day20\Tile;
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    public function testSample1(): void
    {
        $tiles = (new Parser())->parse(trim(file_get_contents(__DIR__ . '/sample.txt')));

        self::assertCount(9, $tiles);

        $edges = (new EdgeFinder())->find(...$tiles);

        self::assertEquals(array_product([1951, 3079, 2971, 1171]), array_product(array_keys($edges)));
    }

    public function testPart1(): void
    {
        $tiles = (new Parser())->parse(trim(file_get_contents(__DIR__ . '/input.txt')));

        $edges = (new EdgeFinder())->find(...$tiles);

        self::assertEquals(79_412_832_860_579, array_product(array_keys($edges)));
    }

    public function testSample2(): void
    {
        // On prend la première tile dans la liste, on la place dans un tableau position (0, 0)
        // On récupère ses voisins (EdgeFinder()->findMatches())
            // Pour chaque voisins, on essaye de les places a coté
                // on va devoir les transfomer pour qu'ils matches et soit du bon cotés
                // on les dépile de la liste

        $tiles = (new Parser())->parse(trim(file_get_contents(__DIR__ . '/sample.txt')));

        $tile = reset($tiles);

        $otherTiles = array_filter($tiles, fn(Tile $t) => $t->id !== $tile->id);

        $this->placeOnMap($tile, $otherTiles, [0, 0]);

        var_dump(array_map(fn($row) => array_map(fn(Tile $t) => $t->id, $row), $this->map));
    }

    protected $map = [];

    public function placeOnMap(Tile $tile, array $otherTiles, array $origin)
    {
        static $placeds = [];

        if (in_array($tile->id, $placeds, true)) {
            return;
        }

        $this->map[$origin[1]][$origin[0]] = $tile;
        $placeds[] = $tile->id;

        $edgeFinder = new EdgeFinder();

        $matches = $edgeFinder->findMatches($tile, $otherTiles);

        foreach ($matches as $match) {
            [$x, $y] = $match->getRelativeCoordinates();

            $neighbor = $match->getTransformedNeighbor();

            $this->placeOnMap(
                $neighbor,
                array_filter($otherTiles, fn(Tile $t) => $t->id !== $neighbor->id),
                [$origin[0] + $x, $origin[1] + $y]
            );
        }
    }
}

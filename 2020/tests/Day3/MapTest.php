<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day3;

use AdventOfCode\Day3\Map;
use AdventOfCode\Day3\Point;
use AdventOfCode\Day3\Slope;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    protected array $sampleMap = [
        '..##.......',
        '#...#...#..',
        '.#....#..#.',
        '..#.#...#.#',
        '.#...##..#.',
        '..#.##.....',
        '.#.#.#....#',
        '.#........#',
        '#.##...#...',
        '#...##....#',
        '.#..#...#.#',
    ];

    /**
     * @dataProvider provideTestCountTrees
     */
    public function testCountTrees(array $input, Slope $slope, int $expectedTrees): void
    {
        $map = new Map($input);

        self::assertEquals($expectedTrees, $map->countTrees($slope));
    }

    public function provideTestCountTrees(): iterable
    {
        yield 'sample' => [
            $this->sampleMap,
            new Slope(3, 1),
            7,
        ];

        $data = explode("\n", trim(file_get_contents(__DIR__ . '/input.txt')));

        yield 'first star' => [
            $data,
            new Slope(3, 1),
            252,
        ];
    }

    /**
     * @dataProvider provideTestBottomReached
     */
    public function testBottomReached(array $input, Point $point, bool $expectedResult): void
    {
        $map = new Map($input);

        self::assertEquals($expectedResult, $map->bottomReached($point));
    }

    public function provideTestBottomReached(): iterable
    {
        yield 'yes' => [
            $this->sampleMap,
            new Point(3, 10),
            true,
        ];

        yield 'false' => [
            $this->sampleMap,
            new Point(3, 1),
            false,
        ];
    }

    /**
     * @dataProvider provideTestIsTree
     */
    public function testIsTree(array $input, Point $point, bool $expectedResult): void
    {
        $map = new Map($input);

        self::assertEquals($expectedResult, $map->isTree($point));
    }

    public function provideTestIsTree(): iterable
    {
        yield 'inside initial map + tree' => [
            $this->sampleMap,
            new Point(2, 0),
            true,
        ];

        yield 'inside initial map + no tree' => [
            $this->sampleMap,
            new Point(2, 1),
            false,
        ];

        yield 'outside initial map + tree' => [
            $this->sampleMap,
            new Point(13, 0),
            true,
        ];

        yield 'outside initial map + no tree' => [
            $this->sampleMap,
            new Point(15, 0),
            false,
        ];
    }

    /**
     * @param Slope[] $slopes
     *
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, array $slopes, int $expectedResult): void
    {
        $map = new Map($input);

        $trees = 1;
        foreach ($slopes as $slope) {
            $trees *= $map->countTrees($slope);
        }

        self::assertEquals($expectedResult, $trees);
    }

    public function provideTestPart2(): iterable
    {
        $slopes = [
            new Slope(1, 1),
            new Slope(3, 1),
            new Slope(5, 1),
            new Slope(7, 1),
            new Slope(1, 2),
        ];

        yield [
            $this->sampleMap,
            $slopes,
            336,
        ];

        $data = explode("\n", trim(file_get_contents(__DIR__ . '/input.txt')));

        yield 'first star' => [
            $data,
            $slopes,
            2_608_962_048,
        ];
    }
}

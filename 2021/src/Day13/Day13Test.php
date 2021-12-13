<?php

declare(strict_types=1);

namespace AOC2021\Day13;

use AOC2021\Day05\Point;
use PHPUnit\Framework\TestCase;

class Day13Test extends TestCase
{
    /**
     * @dataProvider provideTestPart1
     */
    public function testPart1(string $input, int $expectedResult): void
    {
        [$points, $folds] = explode("\n\n", $input);

        $points = array_map(
            static function (string $point) {
                sscanf($point, '%d,%d', $x, $y);

                return new Point($x, $y);
            },
            explode("\n", $points)
        );

        $folds = array_map(function (string $fold) {
            sscanf($fold, 'fold along %1s=%d', $direction, $index);

            return new Fold($direction, $index);
        }, explode("\n", $folds));

        $puzzle = new Puzzle($points);
        $puzzle->fold($folds[0]);

        self::assertCount($expectedResult, $puzzle->points);
    }

    /**
     * @dataProvider provideTestFold
     */
    public function testFold(int $x, int $y, string $foldDirection, int $foldPosition, int $newX, int $newY): void
    {
        $fold = new Fold($foldDirection, $foldPosition);
        $point = new Point($x, $y);

        self::assertEquals(new Point($newX, $newY), $fold->apply($point));
    }

    /**
     * @return iterable<array{int, int, string, int, int, int}>
     */
    public function provideTestFold(): iterable
    {
        yield [6, 10, 'y', 7, 6, 4];
        yield [0, 14, 'y', 7, 0, 0];
        yield [9, 10, 'y', 7, 9, 4];
        yield [0, 3, 'y', 7, 0, 3];
        yield [10, 4, 'y', 7, 10, 4];
        yield [4, 11, 'y', 7, 4, 3];
        yield [6, 0, 'y', 7, 6, 0];
        yield [6, 12, 'y', 7, 6, 2];
        yield [4, 1, 'y', 7, 4, 1];
        yield [0, 13, 'y', 7, 0, 1];
        yield [10, 12, 'y', 7, 10, 2];
        yield [3, 4, 'y', 7, 3, 4];
        yield [3, 0, 'y', 7, 3, 0];
        yield [8, 4, 'y', 7, 8, 4];
        yield [1, 10, 'y', 7, 1, 4];
        yield [2, 14, 'y', 7, 2, 0];
        yield [8, 10, 'y', 7, 8, 4];
        yield [9, 0, 'y', 7, 9, 0];
    }

    /**
     * @return iterable<array{string, int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [$this->getInput('sample.txt'), 17];
        yield 'input' => [$this->getInput('input.txt'), 735];
    }

    /**
     * @dataProvider provideTestPart2
     */
    public function testPart2(string $input, string $expectedResult): void
    {
        [$points, $folds] = explode("\n\n", $input);

        $points = array_map(
            static function (string $point) {
                sscanf($point, '%d,%d', $x, $y);

                return new Point($x, $y);
            },
            explode("\n", $points)
        );

        $folds = array_map(static function (string $fold) {
            sscanf($fold, 'fold along %1s=%d', $direction, $index);

            return new Fold($direction, $index);
        }, explode("\n", $folds));

        $puzzle = new Puzzle($points);

        foreach ($folds as $fold) {
            $puzzle->fold($fold);
        }

        self::assertEquals($expectedResult, (string) $puzzle);
    }

    /**
     * @return iterable<array{string, string}>
     */
    public function provideTestPart2(): iterable
    {
        yield [$this->getInput('sample.txt'), <<<RESULT
#####
#...#
#...#
#...#
#####
RESULT
];
        yield [$this->getInput('input.txt'), <<<RESULT
#..#.####.###..####.#..#..##..#..#.####
#..#.#....#..#....#.#.#..#..#.#..#....#
#..#.###..#..#...#..##...#..#.#..#...#.
#..#.#....###...#...#.#..####.#..#..#..
#..#.#....#.#..#....#.#..#..#.#..#.#...
.##..#....#..#.####.#..#.#..#..##..####
RESULT
];
    }

    protected function getInput(string $filename): string
    {
        return trim((string) file_get_contents(__DIR__ . '/' . $filename));
    }
}

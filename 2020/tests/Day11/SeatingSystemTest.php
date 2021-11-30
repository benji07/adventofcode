<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day11;

use AdventOfCode\Day11\SeatingSystem;
use PHPUnit\Framework\TestCase;

class SeatingSystemTest extends TestCase
{
    public function testSample1Details(): void
    {
        $input = <<<INPUT
L.LL.LL.LL
LLLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLLL
L.LLLLLL.L
L.LLLLL.LL
INPUT;

        $seatingSystem = new SeatingSystem($input);

        self::assertEquals(trim($input), (string) $seatingSystem);

        $seatingSystem->fill();
        self::assertEquals(
            trim(
                <<<OUTPUT
#.##.##.##
#######.##
#.#.#..#..
####.##.##
#.##.##.##
#.#####.##
..#.#.....
##########
#.######.#
#.#####.##
OUTPUT
            ),
            (string) $seatingSystem
        );

        $seatingSystem->fill();
        $seatingSystem->fill();
        self::assertEquals(
            trim(
                <<<OUTPUT
#.##.L#.##
#L###LL.L#
L.#.#..#..
#L##.##.L#
#.##.LL.LL
#.###L#.##
..#.#.....
#L######L#
#.LL###L.L
#.#L###.##
OUTPUT
            ),
            (string) $seatingSystem
        );

        $seatingSystem->fill();
        self::assertEquals(
            trim(
                <<<OUTPUT
#.#L.L#.##
#LLL#LL.L#
L.L.L..#..
#LLL.##.L#
#.LL.LL.LL
#.LL#L#.##
..L.L.....
#L#LLLL#L#
#.LLLLLL.L
#.#L#L#.##
OUTPUT
            ),
            (string) $seatingSystem
        );

        $seatingSystem->fill();
        self::assertEquals(
            trim(
                <<<OUTPUT
#.#L.L#.##
#LLL#LL.L#
L.#.L..#..
#L##.##.L#
#.#L.LL.LL
#.#L#L#.##
..L.L.....
#L#L##L#L#
#.LLLLLL.L
#.#L#L#.##
OUTPUT
            ),
            (string) $seatingSystem
        );
        $changed = $seatingSystem->fill();
        self::assertFalse($changed);
        self::assertEquals(37, $seatingSystem->countOccupiedSeats());
    }

    public function testSample1(): void
    {
        $input = <<<INPUT
L.LL.LL.LL
LLLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLLL
L.LLLLLL.L
L.LLLLL.LL
INPUT;

        $seatingSystem = new SeatingSystem($input);
        $seatingSystem->resolve();
        self::assertEquals(37, $seatingSystem->countOccupiedSeats());
    }

    public function testPart1(): void
    {
        $seatingSystem = new SeatingSystem(file_get_contents(__DIR__ . '/input.txt'));
        $seatingSystem->resolve();

        self::assertEquals(2281, $seatingSystem->countOccupiedSeats());
    }

    /**
     * @dataProvider provideTestCountOccupiedSeatsPart2
     */
    public function testCountOccupiedSeatsPart2(string $input, int $x, int $y, int $expectedResult): void
    {
        $seatingSystem = new SeatingSystem($input);

        self::assertEquals($expectedResult, $seatingSystem->countOccupiedAdjacentCell($x, $y, false));
    }

    public function provideTestCountOccupiedSeatsPart2(): iterable
    {
        yield [
            <<<INPUT
.......#.
...#.....
.#.......
.........
..#L....#
....#....
.........
#........
...#.....
INPUT,
            3,
            4,
            8,
        ];

        yield [
            <<<INPUT
.............
.L.L.#.#.#.#.
.............
INPUT,
            1,
            1,
            0,
        ];

        yield [
            <<<INPUT
.##.##.
#.#.#.#
##...##
...L...
##...##
#.#.#.#
.##.##.
INPUT,
            3,
            3,
            0,
        ];
    }

    public function testSample2Details(): void
    {
        $input = <<<INPUT
L.LL.LL.LL
LLLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLLL
L.LLLLLL.L
L.LLLLL.LL
INPUT;
        $iterations = [
            <<<INPUT
#.##.##.##
#######.##
#.#.#..#..
####.##.##
#.##.##.##
#.#####.##
..#.#.....
##########
#.######.#
#.#####.##
INPUT,
            <<<INPUT
#.LL.LL.L#
#LLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLL#
#.LLLLLL.L
#.LLLLL.L#
INPUT,
            <<<INPUT
#.L#.##.L#
#L#####.LL
L.#.#..#..
##L#.##.##
#.##.#L.##
#.#####.#L
..#.#.....
LLL####LL#
#.L#####.L
#.L####.L#
INPUT,
            <<<INPUT
#.L#.L#.L#
#LLLLLL.LL
L.L.L..#..
##LL.LL.L#
L.LL.LL.L#
#.LLLLL.LL
..L.L.....
LLLLLLLLL#
#.LLLLL#.L
#.L#LL#.L#
INPUT,
            <<<INPUT
#.L#.L#.L#
#LLLLLL.LL
L.L.L..#..
##L#.#L.L#
L.L#.#L.L#
#.L####.LL
..#.#.....
LLL###LLL#
#.LLLLL#.L
#.L#LL#.L#
INPUT,
            <<<INPUT
#.L#.L#.L#
#LLLLLL.LL
L.L.L..#..
##L#.#L.L#
L.L#.LL.L#
#.LLLL#.LL
..#.L.....
LLL###LLL#
#.LLLLL#.L
#.L#LL#.L#
INPUT
    ,
        ];

        $seatingSystem = new SeatingSystem($input);

        foreach ($iterations as $iteration) {
            $seatingSystem->fill(false, 5);
            self::assertEquals($iteration, (string) $seatingSystem);
        }

        self::assertEquals(26, $seatingSystem->countOccupiedSeats());
    }

    public function testSample2(): void
    {
        $input = <<<INPUT
L.LL.LL.LL
LLLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLLL
L.LLLLLL.L
L.LLLLL.LL
INPUT;

        $seatingSystem = new SeatingSystem($input);
        $seatingSystem->resolve(false, 5);
        self::assertEquals(26, $seatingSystem->countOccupiedSeats());
    }

    public function testPart2(): void
    {
        $seatingSystem = new SeatingSystem(file_get_contents(__DIR__ . '/input.txt'));
        $seatingSystem->resolve(false, 5);

        self::assertEquals(2085, $seatingSystem->countOccupiedSeats());
    }
}

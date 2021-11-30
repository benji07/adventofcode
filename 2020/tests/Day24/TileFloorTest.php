<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day24;

use AdventOfCode\Day24\Coordinate;
use AdventOfCode\Day24\Parser;
use AdventOfCode\Day24\TileFloor;
use PHPUnit\Framework\TestCase;

class TileFloorTest extends TestCase
{
    /**
     * @dataProvider provideTestParse
     */
    public function testParse(string $input, array $expextedDirections): void
    {
        $parser = new Parser();
        self::assertEquals($expextedDirections, $parser->parse($input));
    }

    public function provideTestParse(): iterable
    {
        yield ['esew', ['e', 'se', 'w']];
        yield ['nwwswee', ['nw', 'w', 'sw', 'e', 'e']];
    }

    public function testMove(): void
    {
        self::assertEquals(new Coordinate(0, 0, 0), Coordinate::fromInput('nwwswee'));
    }

    public function testSample1(): void
    {
        $inputs = explode("\n", trim(file_get_contents(__DIR__ . '/sample.txt')));

        $floor = new TileFloor();
        $floor->renovate($inputs);

        self::assertCount(10, $floor->tiles);
    }

    public function testPart1(): void
    {
        $inputs = explode("\n", trim(file_get_contents(__DIR__ . '/input.txt')));

        $floor = new TileFloor();
        $floor->renovate($inputs);

        self::assertCount(549, $floor->tiles);
    }

    public function testSample2(): void
    {
        $inputs = explode("\n", trim(file_get_contents(__DIR__ . '/sample.txt')));

        $floor = new TileFloor();
        $floor->renovate($inputs);

        self::assertCount(10, $floor->tiles);

        $iterations = [
            1 => 15,
            2 => 12,
            3 => 25,
            4 => 14,
            5 => 23,
            6 => 28,
            7 => 41,
            8 => 37,
            9 => 49,
            10 => 37,
            20 => 132,
            30 => 259,
            40 => 406,
            50 => 566,
            60 => 788,
            70 => 1106,
            80 => 1373,
            90 => 1844,
            100 => 2208,
        ];

        for ($i = 1; $i < array_key_last($iterations); ++$i) {
            $floor->flip();

            if (\array_key_exists($i, $iterations)) {
                self::assertCount($iterations[$i], $floor->tiles);
            }
        }
    }

    public function testPart2(): void
    {
        $inputs = explode("\n", trim(file_get_contents(__DIR__ . '/input.txt')));

        $floor = new TileFloor();
        $floor->renovate($inputs);

        self::assertCount(549, $floor->tiles);

        for ($i = 1; $i <= 100; ++$i) {
            $floor->flip();
        }
        self::assertCount(4147, $floor->tiles);
    }
}

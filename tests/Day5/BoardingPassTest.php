<?php

namespace AdventOfCode\Tests\Day5;

use AdventOfCode\Day5\BoardingPass;
use AdventOfCode\Day5\HighestSeatFinder;
use AdventOfCode\Day5\MissingSeatFinder;
use PHPUnit\Framework\TestCase;

class BoardingPassTest extends TestCase
{
    /**
     * @dataProvider provideTestParsing
     */
    public function testParsing(string $value, int $expectedRow, int $expectedColumn, int $expectedSeatID): void
    {
        $boardingPass = new BoardingPass($value);

        self::assertEquals($expectedRow, $boardingPass->row);
        self::assertEquals($expectedColumn, $boardingPass->column);
        self::assertEquals($expectedSeatID, $boardingPass->seatID);
    }

    public function provideTestParsing(): iterable
    {
        yield ['BFFFBBFRRR', 70, 7, 567];
        yield ['FFFBBBFRRR', 14, 7, 119];
        yield ['BBFFBBFRLL', 102, 4, 820];
    }

    public function testPart1(): void
    {
        $data = explode("\n", trim(file_get_contents(__DIR__.'/input.txt')));

        $boardingPasses = array_map(fn(string $seat): BoardingPass => new BoardingPass($seat), $data);

        $maxSeatId = (new HighestSeatFinder())->find(...$boardingPasses);

        self::assertEquals(858, $maxSeatId);
    }

    public function testPart2(): void
    {
        $data = explode("\n", trim(file_get_contents(__DIR__.'/input.txt')));

        $boardingPasses = array_map(fn(string $seat): BoardingPass => new BoardingPass($seat), $data);

        $maxSeatId = (new MissingSeatFinder())->find(...$boardingPasses);

        self::assertEquals(557, $maxSeatId);
    }
}

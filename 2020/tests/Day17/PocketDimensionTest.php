<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day17;

use AdventOfCode\Day17\Cube;
use AdventOfCode\Day17\PocketDimension;
use AdventOfCode\Day17\PocketDimension4;
use PHPUnit\Framework\TestCase;

class PocketDimensionTest extends TestCase
{
    public function testSample1(): void
    {
        $pocketDimension = PocketDimension::createFromString(file_get_contents(__DIR__ . '/sample.txt'));

        self::assertEquals(5, $pocketDimension->count());

        // cycle 1
        self::assertEquals(11, $pocketDimension->cycleNTimes(1)->count());

        // cycle 2
        self::assertEquals(21, $pocketDimension->cycleNTimes(2)->count());

        // cycle 3
        self::assertEquals(38, $pocketDimension->cycleNTimes(3)->count());

        // cycle 4 to 6
        self::assertEquals(112, $pocketDimension->cycleNTimes(6)->count());
    }

    public function testPart1(): void
    {
        $pocketDimension = PocketDimension::createFromString(file_get_contents(__DIR__ . '/input.txt'));

        // cycle 1 To 6
        $pocketDimension = $pocketDimension->cycleNTimes(6);
        self::assertEquals(317, $pocketDimension->count());
    }

    public function testSample2(): void
    {
        $pocketDimension = PocketDimension4::createFromString(file_get_contents(__DIR__ . '/sample.txt'));

        self::assertEquals(5, $pocketDimension->count());

        // cycle 4 to 6
        self::assertEquals(848, $pocketDimension->cycleNTimes(6)->count());
    }

    public function testPart2(): void
    {
        $pocketDimension = PocketDimension4::createFromString(file_get_contents(__DIR__ . '/input.txt'));

        // cycle 1 To 6
        $pocketDimension = $pocketDimension->cycleNTimes(6);
        self::assertEquals(1692, $pocketDimension->count());
    }

    public function testGetNeighbors(): void
    {
        $cube = new Cube(0, 0, 0);
        $dimension = new PocketDimension([$cube]);

        $neighbors = $dimension->getNeighbors($cube);

        self::assertCount(9 + 9 + 8, $neighbors);
    }
}

<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day13;

use AdventOfCode\Day13\ShuttleSearch;
use PHPUnit\Framework\TestCase;

class ShuttleSearchTest extends TestCase
{
    public function testSample1(): void
    {
        [$timestamp, $buses] = $this->getInput(__DIR__ . '/sample.txt');

        $shuttleSearch = new ShuttleSearch($buses);

        self::assertEquals(295, $shuttleSearch->search($timestamp));
    }

    public function testPart1(): void
    {
        [$timestamp, $buses] = $this->getInput(__DIR__ . '/input.txt');
        $shuttleSearch = new ShuttleSearch($buses);

        self::assertEquals(6568, $shuttleSearch->search($timestamp));
    }

    public function getInput(string $filename): array
    {
        [$timestamp, $buses] = explode("\n", trim(file_get_contents($filename)));
        $buses = array_map('intval', array_filter(explode(',', $buses), fn ($bus) => $bus != 'x'));

        return [(int) $timestamp, $buses];
    }

    public function testSample2(): void
    {
        [, $buses] = $this->getInput(__DIR__ . '/sample.txt');

        $shuttleSearch = new ShuttleSearch($buses);

        self::assertEquals(1_068_781, $shuttleSearch->getEarliestTime());
    }

    /**
     * @dataProvider provideTesOtherSamples2
     */
    public function testOtherSamples2(string $buses, int $expectedTimestamp): void
    {
        $buses = array_map('intval', array_filter(explode(',', $buses), fn ($bus) => $bus != 'x'));
        $shuttleSearch = new ShuttleSearch($buses);

        self::assertEquals($expectedTimestamp, $shuttleSearch->getEarliestTime());
    }

    public function provideTesOtherSamples2(): iterable
    {
        yield ['17,x,13,19', 3417];
        yield ['67,7,59,61', 754_018];
        yield ['67,x,7,59,61', 779_210];
        yield ['67,7,x,59,61', 1_261_476];
        yield ['1789,37,47,1889', 1_202_161_486];
    }

    public function testPart2(): void
    {
        [, $buses] = $this->getInput(__DIR__ . '/input.txt');

        $shuttleSearch = new ShuttleSearch($buses);

        self::assertEquals(554_865_447_501_099, $shuttleSearch->getEarliestTime());
    }
}

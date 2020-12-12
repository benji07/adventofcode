<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day6;

use AdventOfCode\Day6\Group;
use AdventOfCode\Day6\InputParser;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    /**
     * @dataProvider provideTestCount
     */
    public function testCount(string $input, int $expectedCount): void
    {
        $group = new Group(...explode("\n", $input));

        self::assertEquals($expectedCount, $group->count());
    }

    public function provideTestCount(): iterable
    {
        yield ['abc', 3];

        yield [
            'a
b
c',
            3,
        ];

        yield [
            'ab
ac',
            3,
        ];

        yield [
            'a
a
a
a',
            1,
        ];

        yield ['b', 1];
    }

    public function testPart1(): void
    {
        $groups = (new InputParser())->parse(file_get_contents(__DIR__ . '/input.txt'));

        self::assertEquals(6775, $groups->getPart1Result());
    }

    /**
     * @dataProvider provideTestCountYes
     */
    public function testCountYes(string $input, int $expectedCount): void
    {
        $group = new Group(...explode("\n", $input));

        self::assertEquals($expectedCount, $group->countYes());
    }

    public function provideTestCountYes(): iterable
    {
        yield ['abc', 3];

        yield [
            'a
b
c',
            0,
        ];

        yield [
            'ab
ac',
            1,
        ];

        yield [
            'a
a
a
a',
            1,
        ];

        yield ['b', 1];
    }

    public function testPart2(): void
    {
        $groups = (new InputParser())->parse(file_get_contents(__DIR__ . '/input.txt'));

        self::assertEquals(3356, $groups->getPart2Result());
    }
}

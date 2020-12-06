<?php

namespace AdventOfCode\Tests\Day6;

use AdventOfCode\Day6\Group;
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
        yield ["abc", 3];

        yield [
            "a
b
c",
            3,
        ];

        yield [
            "ab
ac",
            3,
        ];

        yield [
            "a
a
a
a",
            1,
        ];

        yield ["b", 1];
    }

    public function testPart1(): void
    {
        $input = explode("\n\n", trim(file_get_contents(__DIR__.'/input.txt')));

        $result = array_sum(array_map(fn(string $group): int => (new Group(...explode("\n", $group)))->count(), $input));

        self::assertEquals(6775, $result);
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
        yield ["abc", 3];

        yield [
            "a
b
c",
            0,
        ];

        yield [
            "ab
ac",
            1,
        ];

        yield [
            "a
a
a
a",
            1,
        ];

        yield ["b", 1];
    }

    public function testPart2(): void
    {
        $input = explode("\n\n", trim(file_get_contents(__DIR__.'/input.txt')));

        $result = array_sum(array_map(fn(string $group): int => (new Group(...explode("\n", $group)))->countYes(), $input));

        self::assertEquals(3356, $result);
    }
}

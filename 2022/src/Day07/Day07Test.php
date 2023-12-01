<?php

declare(strict_types=1);

namespace AOC2022\Day07;

use PHPUnit\Framework\TestCase;

class Day07Test extends TestCase
{
    /**
     * @dataProvider provideTestPart1
     */
    public function testPart1(string $input, int $expectedResult): void
    {
        $runner = new Part1();

        $result = $runner($input);

        self::assertEquals($expectedResult, $result);
    }

    /**
     * @return iterable<array{string, int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [(string) file_get_contents(__DIR__ . '/sample.txt'), 95437];
//        yield 'input' => [(string) file_get_contents(__DIR__ . '/input.txt'), 0];
    }

    /**
     * @dataProvider provideTestPart2
     */
    public function testPart2(string $input, int $expectedResult): void
    {
        $runner = new Part2();

        $result = $runner($input);

        self::assertEquals($expectedResult, $result);
    }

    /**
     * @return iterable<array{string, int}>
     */
    public function provideTestPart2(): iterable
    {
//        yield 'sample' => [(string) file_get_contents(__DIR__ . '/sample.txt'), 0];
//        yield 'input' => [(string) file_get_contents(__DIR__ . '/input.txt'), 0];
    }
}

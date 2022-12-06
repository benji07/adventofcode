<?php

declare(strict_types=1);

namespace AOC2022\Day05;

use PHPUnit\Framework\TestCase;

class Day05Test extends TestCase
{
    /**
     * @dataProvider provideTestPart1
     */
    public function testPart1(string $input, string $expectedResult): void
    {
        $runner = new Part1();

        $result = $runner($input);

        self::assertEquals($expectedResult, $result);
    }

    /**
     * @return iterable<array{string, string}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [(string) file_get_contents(__DIR__ . '/sample.txt'), 'CMZ'];
        yield 'input' => [(string) file_get_contents(__DIR__ . '/input.txt'), 'PSNRGBTFT'];
    }

    /**
     * @dataProvider provideTestPart2
     */
    public function testPart2(string $input, string $expectedResult): void
    {
        $runner = new Part2();

        $result = $runner($input);

        self::assertEquals($expectedResult, $result);
    }

    /**
     * @return iterable<array{string, string}>
     */
    public function provideTestPart2(): iterable
    {
        yield 'sample' => [(string) file_get_contents(__DIR__ . '/sample.txt'), 'MCD'];
        yield 'input' => [(string) file_get_contents(__DIR__ . '/input.txt'), 'BNTZFPMMW'];
    }
}

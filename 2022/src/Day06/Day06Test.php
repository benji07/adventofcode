<?php

declare(strict_types=1);

namespace AOC2022\Day06;

use PHPUnit\Framework\TestCase;

class Day06Test extends TestCase
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
        yield 'sample 1' => ['mjqjpqmgbljsphdztnvjfqwrcgsmlb', 7];
        yield 'sample 2' => ['bvwbjplbgvbhsrlpgdmjqwftvncz', 5];
        yield 'sample 3' => ['nppdvjthqldpwncqszvftbrmjlhg', 6];
        yield 'sample 4' => ['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg', 10];
        yield 'sample 5' => ['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw', 11];
        yield 'input' => [trim((string) file_get_contents(__DIR__ . '/input.txt')), 1_833];
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
        yield 'sample 1' => ['mjqjpqmgbljsphdztnvjfqwrcgsmlb', 19];
        yield 'sample 2' => ['bvwbjplbgvbhsrlpgdmjqwftvncz', 23];
        yield 'sample 3' => ['nppdvjthqldpwncqszvftbrmjlhg', 23];
        yield 'sample 4' => ['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg', 29];
        yield 'sample 5' => ['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw', 26];
        yield 'input' => [trim((string) file_get_contents(__DIR__ . '/input.txt')), 3_425];
    }
}

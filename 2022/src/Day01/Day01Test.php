<?php

declare(strict_types=1);

namespace AOC2022\Day01;

use PHPUnit\Framework\TestCase;

class Day01Test extends TestCase
{
    /**
     * @dataProvider provideTestPart1
     */
    public function testPart1(string $input, int $expectedResult): void
    {
        $result = max(
            array_map(
                'array_sum',
                array_map(
                    static fn (string $elf): array => array_map('intval', explode("\n", $elf)),
                    explode("\n\n", $input))
            )
        );

        self::assertEquals($expectedResult, $result);
    }

    /**
     * @return iterable<array{string, int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [
            <<<INPUT
1000
2000
3000

4000

5000
6000

7000
8000
9000

10000
INPUT,
            24_000,
        ];

        yield 'input' => [(string) file_get_contents(__DIR__ . '/input.txt'), 69_883];
    }

    /**
     * @dataProvider provideTestPart2
     */
    public function testPart2(string $input, int $expectedResult): void
    {
        $elves = array_map(
            'array_sum',
            array_map(
                static fn (string $elf): array => array_map('intval', explode("\n", $elf)),
                explode("\n\n", $input))
        );

        rsort($elves);
        $top3 = \array_slice($elves, 0, 3);

        self::assertEquals($expectedResult, array_sum($top3));
    }

    /**
     * @return iterable<array{string, int}>
     */
    public function provideTestPart2(): iterable
    {
        yield 'sample' => [
            <<<INPUT
1000
2000
3000

4000

5000
6000

7000
8000
9000

10000
INPUT,
            45_000,
        ];

        yield 'input' => [(string) file_get_contents(__DIR__ . '/input.txt'), 207_576];
    }
}

<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day18;

use AdventOfCode\Day18\SolverPart1;
use PHPUnit\Framework\TestCase;

class FormulaTest extends TestCase
{
    /**
     * @dataProvider provideTestSolve
     */
    public function testSolve(string $input, int $value): void
    {
        self::assertEquals($value, (new SolverPart1())->solve($input));
    }

    public function provideTestSolve(): iterable
    {
        yield ['1 + 1', 2];
        yield ['2 * 2', 4];
        yield 'simple' => ['1 + 2 * 3 + 4 * 5 + 6', 71];
        yield 'parentheses' => ['1 + (2 * 3) + (4 * (5 + 6))', 51];
        yield ['2 * 3 + (4 * 5)', 26];
        yield ['5 + (8 * 3 + 9 + 3 * 4 * 3)', 437];
        yield ['5 * 9 * (7 * 3 * 3 + 9 * 3 + (8 + 6 * 4))', 12240];
        yield ['((2 + 4 * 9) * (6 + 9 * 8 + 6) + 6) + 2 + 4 * 2', 13632];
    }

    public function testPart1()
    {
        self::assertEquals(
            11_076_907_812_171,
            array_sum(
                array_map(
                    fn (string $formula) => (new SolverPart1())->solve($formula),
                    file(__DIR__ . '/input.txt')
                )
            )
        );
    }
}

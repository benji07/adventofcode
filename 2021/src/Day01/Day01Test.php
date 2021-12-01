<?php

declare(strict_types=1);

namespace AOC2021\Day01;

use PHPUnit\Framework\TestCase;

class Day01Test extends TestCase
{
    /**
     * @dataProvider provideTestPart1
     */
    public function testPart1(array $input, int $expectedValue): void
    {
        $increase = 0;
        $count = count($input);

        for ($i = 1; $i < $count; $i++) {
            if ($input[$i] > $input[$i - 1]) {
                $increase++;
            }
        }

        self::assertEquals($expectedValue, $increase);
    }

    public function provideTestPart1(): iterable
    {
        yield [$this->getSampleInput(), 7];
        yield [$this->getInput(), 1681];
    }

    /**
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, int $expectedValue): void
    {
        $increase = 0;
        $count = count($input);

        for ($i = 1; $i < $count; $i++) {
            $previous = array_sum(array_slice($input, $i - 1, 3));
            $current = array_sum(array_slice($input, $i, 3));

            if ($current > $previous) {
                $increase++;
            }
        }

        self::assertEquals($expectedValue, $increase);
    }

    public function provideTestPart2(): iterable
    {
        yield [$this->getSampleInput(), 5];
        yield [$this->getInput(), 1704];
    }

    private function getSampleInput(): array
    {
        return [
            199,
            200,
            208,
            210,
            200,
            207,
            240,
            269,
            260,
            263,
        ];
    }

    protected function getInput(): array
    {
        return array_map('intval', file(__DIR__.'/input.txt'));
    }
}

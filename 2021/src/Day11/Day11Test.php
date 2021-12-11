<?php

declare(strict_types=1);

namespace AOC2021\Day11;

use PHPUnit\Framework\TestCase;

class Day11Test extends TestCase
{
    /**
     * @param int[][] $input
     *
     * @dataProvider provideTestPart1
     */
    public function testPart1(array $input, int $step, int $expectedResult): void
    {
        $totalFlashes = 0;
        $data = new Octopuses($input);
        for ($i = 1; $i <= $step; ++$i) {
            $totalFlashes += \count($data->step());
        }

        self::assertEquals($expectedResult, $totalFlashes);
    }

    /**
     * @return iterable<array{int[][], int, int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'tiny' => [
            [
                [1, 1, 1, 1, 1],
                [1, 9, 9, 9, 1],
                [1, 9, 1, 9, 1],
                [1, 9, 9, 9, 1],
                [1, 1, 1, 1, 1],
            ],
            2,
            9,
        ];
        yield 'sample 10' => [$this->getSampleInput(), 10, 204];
        yield 'sample 100' => [$this->getSampleInput(), 100, 1656];
        yield 'input' => [$this->getInput(), 100, 1637];
    }

    /**
     * @param int[][] $input
     *
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, int $expectedResult): void
    {
        $data = new Octopuses($input);
        $steps = 0;
        do {
            ++$steps;
        } while (\count($data->step()) !== 100);

        self::assertEquals($expectedResult, $steps);
    }

    /**
     * @return iterable<array{int[][], int}>
     */
    public function provideTestPart2(): iterable
    {
        yield [$this->getSampleInput(), 195];
        yield [$this->getInput(), 242];
    }

    /**
     * @return int[][]
     */
    private function getSampleInput(): array
    {
        $file = file(__DIR__ . '/sample.txt');

        \assert(\is_array($file));

        return array_map(function ($row) {
            return array_map('intval', str_split(trim($row)));
        }, $file);
    }

    /**
     * @return int[][]
     */
    protected function getInput(): array
    {
        $file = file(__DIR__ . '/input.txt');

        \assert(\is_array($file));

        return array_map(function ($row) {
            return array_map('intval', str_split(trim($row)));
        }, $file);
    }
}

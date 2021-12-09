<?php

declare(strict_types=1);

namespace AOC2021\Day09;

use AOC2021\Day05\Point;
use PHPUnit\Framework\TestCase;

class Day09Test extends TestCase
{
    /**
     * @param int[][] $input
     *
     * @dataProvider provideTestPart1
     */
    public function testPart1(array $input, int $expectedResult): void
    {
        $cave = new Cave($input);
        $lowPoints = array_map(function (Point $point) use ($cave) {
            return $cave->getValue($point);
        }, $cave->findLowPoints());

        self::assertEquals($expectedResult, array_sum($lowPoints) + \count($lowPoints));
    }

    /**
     * @return iterable<array{int[][], int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [$this->getSampleInput(), 15];
        yield 'input' => [$this->getInput(), 524];
    }

    /**
     * @param int[][] $input
     *
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, int $expectedResult): void
    {
        $cave = new Cave($input);
        $lowPoints = $cave->findLowPoints();

        $basinSize = [];
        foreach ($lowPoints as $lowPoint) {
            $basinSize[] = \count($cave->getBasin($lowPoint));
        }

        rsort($basinSize);

        self::assertEquals($expectedResult, array_product(\array_slice($basinSize, 0, 3)));
    }

    /**
     * @return iterable<array{int[][], int}>
     */
    public function provideTestPart2(): iterable
    {
        yield [$this->getSampleInput(), 1134];
        yield [$this->getInput(), 1_235_430];
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

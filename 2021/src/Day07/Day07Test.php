<?php

declare(strict_types=1);

namespace AOC2021\Day07;

use PHPUnit\Framework\TestCase;

class Day07Test extends TestCase
{
    /**
     * @param int[] $input
     *
     * @dataProvider provideTestPart1
     */
    public function testPart1(array $input, int $expectedResult): void
    {
        $max = (int) max($input);
        $range = range((int) min($input), $max);

        $fuel = null;

        foreach ($range as $i) {
            $sum = array_sum(array_map(fn ($value) => abs($i - $value), $input));
            if ($fuel === null) {
                $fuel = $sum;

                continue;
            }
            $fuel = min($fuel, $sum);
        }

        self::assertEquals($expectedResult, $fuel);
    }

    /**
     * @return iterable<array{int[], int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [$this->getSampleInput(), 37];
        yield 'input' => [$this->getInput(), 344_535];
    }

    /**
     * @param int[] $input
     *
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, int $expectedResult): void
    {
        $max = (int) max($input);
        $range = range((int) min($input), $max);

        $fuel = null;

        foreach ($range as $i) {
            $detail = array_map(fn ($value) => $this->getFuelConsumption((int) abs($value - $i)), $input);
            $sum = array_sum($detail);

            if ($fuel === null) {
                $fuel = $sum;
            }

            $fuel = min($fuel, $sum);
        }

        self::assertEquals($expectedResult, $fuel);
    }

    private function getFuelConsumption(int $distance): int
    {
        static $consumption = [0 => 0, 1 => 1];

        if (\array_key_exists($distance, $consumption)) {
            return $consumption[$distance];
        }

        return $consumption[$distance] = $this->getFuelConsumption($distance - 1) + $distance;
    }

    /**
     * @return iterable<array{int[], int}>
     */
    public function provideTestPart2(): iterable
    {
        yield [$this->getSampleInput(), 168];
        yield [$this->getInput(), 95_581_659];
    }

    /**
     * @return int[]
     */
    private function getSampleInput(): array
    {
        return [
            16, 1, 2, 0, 4, 2, 7, 1, 2, 14,
        ];
    }

    /**
     * @return int[]
     */
    protected function getInput(): array
    {
        return array_map('intval', explode(',', (string) file_get_contents(__DIR__ . '/input.txt')));
    }
}

<?php

declare(strict_types=1);

namespace AOC2021\Day06;

use PHPUnit\Framework\TestCase;

class Day06Test extends TestCase
{
    /**
     * @param int[] $input
     *
     * @dataProvider provideTestPart
     */
    public function testPart(array $input, int $iteration, int $expectedResult): void
    {
        $data = array_count_values($input) + array_fill(0, 9, 0);

        for ($i = 0; $i < $iteration; ++$i) {
            $current = array_fill(0, 9, 0);
            for ($j = 1; $j <= 8; ++$j) {
                $current[$j - 1] = $data[$j];
            }

            $current[6] += $data[0];
            $current[8] = $data[0];
            $data = $current;
        }

        self::assertEquals($expectedResult, array_sum($data));
    }

    /**
     * @return iterable<array{int[], int, int}>
     */
    public function provideTestPart(): iterable
    {
        yield 'sample short' => [$this->getSampleInput(), 18, 26];
        yield 'sample' => [$this->getSampleInput(), 80, 5934];
        yield 'part 1' => [$this->getInput(), 80, 380243];
        yield 'sample part 2' => [$this->getSampleInput(), 256, 26_984_457_539];
        yield 'part 2' => [$this->getInput(), 256, 1_708_791_884_591];
    }

    /**
     * @return int[]
     */
    private function getSampleInput(): array
    {
        return [
            3, 4, 3, 1, 2,
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

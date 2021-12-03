<?php

declare(strict_types=1);

namespace AOC2021\Day03;

use PHPUnit\Framework\TestCase;

class Day03Test extends TestCase
{
    /**
     * @param string[] $input
     *
     * @dataProvider provideTestPart1
     */
    public function testPart1(array $input, int $expectedResult): void
    {
        $length = \strlen((string) current($input));
        $count = \count($input);

        $splitInput = array_map(fn (string $binary) => str_split($binary), $input);

        $gammaRate = '';
        $epsilonRate = '';
        for ($i = 0; $i < $length; ++$i) {
            $value = array_sum(array_column($splitInput, $i));
            if ($value > $count / 2) {
                $gammaRate .= '1';
                $epsilonRate .= '0';
            } else {
                $gammaRate .= '0';
                $epsilonRate .= '1';
            }
        }

        $gammaRate = bindec($gammaRate);
        $epsilonRate = bindec($epsilonRate);

        self::assertEquals($expectedResult, $gammaRate * $epsilonRate);
    }

    /**
     * @return iterable<array{string[], int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [$this->getSampleInput(), 198];
        yield 'input' => [$this->getInput(), 3_320_834];
    }

    /**
     * @param string[] $input
     *
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, int $expectedResult): void
    {
        $splitInput = array_map(fn (string $binary) => str_split($binary), $input);

        $oxygenGeneratorRating = $splitInput;
        $bit = 0;
        while (\count($oxygenGeneratorRating) > 1) {
            $countValues = array_count_values(array_column($oxygenGeneratorRating, $bit));

            $keepValue = $countValues[0] > $countValues[1] ? '0' : '1';

            $oxygenGeneratorRating = array_filter($oxygenGeneratorRating, fn ($item) => $item[$bit] === $keepValue);

            ++$bit;
        }

        $oxygenGeneratorRating = bindec(implode((array) current($oxygenGeneratorRating)));

        $co2GeneratorRating = $splitInput;
        $bit = 0;
        while (\count($co2GeneratorRating) > 1) {
            $countValues = array_count_values(array_column($co2GeneratorRating, $bit));

            $keepValue = $countValues[0] > $countValues[1] ? '1' : '0';

            $co2GeneratorRating = array_filter($co2GeneratorRating, fn ($item) => $item[$bit] === $keepValue);

            ++$bit;
        }

        $co2GeneratorRating = bindec(implode((array) current($co2GeneratorRating)));

        self::assertEquals($expectedResult, $oxygenGeneratorRating * $co2GeneratorRating);
    }

    /**
     * @return iterable<array{string[], int}>
     */
    public function provideTestPart2(): iterable
    {
        yield [$this->getSampleInput(), 230];
        yield [$this->getInput(), 4_481_199];
    }

    /**
     * @return string[]
     */
    private function getSampleInput(): array
    {
        return [
            '00100',
            '11110',
            '10110',
            '10111',
            '10101',
            '01111',
            '00111',
            '11100',
            '10000',
            '11001',
            '00010',
            '01010',
        ];
    }

    /**
     * @return string[]
     */
    protected function getInput(): array
    {
        $file = file(__DIR__ . '/input.txt');

        \assert(\is_array($file));

        return array_map('trim', $file);
    }
}

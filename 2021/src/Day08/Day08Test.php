<?php

namespace AOC2021\Day08;

use PHPUnit\Framework\TestCase;

class Day08Test extends TestCase
{
    /**
     * @param string[] $input
     *
     * @dataProvider provideTestPart1
     */
    public function testPart1(array $input, int $expectedResult): void
    {
        $digits = [
            1 => 2, 4 => 4, 7 => 3, 8 => 7
        ];

        $input = $this->parseInput($input);

        $found = 0;

        foreach ($input as $entry) {
            foreach ($entry['values'] as $value) {
                if (in_array(strlen($value), $digits)) {
                    $found++;
                }
            }
        }

        self::assertEquals($expectedResult, $found);
    }

    /**
     * @return iterable<array{int[], int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [$this->getSampleInput(), 26];
        yield 'input' => [$this->getInput(), 534];
    }

    /**
     * @param int[] $input
     *
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, int $expectedResult): void
    {
        $input = $this->parseInput($input);

        $digits = [];

        $patterns = array_column($input, 'patterns')[0];
        foreach ($patterns as $i => $pattern) {
            switch (strlen($pattern)) {
                case 2: // 1
                    $digits[1] = str_split($pattern);
                    unset($patterns[$i]);
                    break;
                case 3: // 7
                    $digits[7] = str_split($pattern);
                    unset($patterns[$i]);
                    break;
                case 4: // 4
                    $digits[4] = str_split($pattern);
                    unset($patterns[$i]);
                    break;
                case 7: // 8
                    $digits[8] = str_split($pattern);
                    unset($patterns[$i]);
                    break;
                case 5: // 2, 3, 5
                    break;
                case 6: // 0, 6, 9
                    break;
            }
        }

        $letters = [
            'top' => array_diff($digits[7], $digits[1]),
            'top-right' => [],
            'top-left' => [],
            'middle' => [],
            'bottom-right' => [],
            'bottom-left' => [],
            'bottom' => []
        ];

        foreach ($patterns as $i => $pattern) {
            switch (strlen($pattern)) {
                case 5: // 2, 3, 5
                    break;
                case 6:
                    $letter = current(array_diff($digits[8], str_split($pattern)));

                    if (!in_array($letter, $digits[1])) {
                        $digits[0] = str_split($pattern);
                        $letters['middle'] = [$letter];

                        unset($patterns[$i]);
                    }
                    // possible digits = 0, 6, 9
                    break;
            }
        }

        var_dump($digits, $letters);

        die();

        // trouver les digits a partir de tout les lignes qui sont dans $input[x]['pattern']
        // pour chaque entry
            // generer le nombre a partir des pattern
        // faire la somme des valeurs
    }

    /**
     * @return iterable<array{int[], int}>
     */
    public function provideTestPart2(): iterable
    {
        yield [
            ['acedgfb cdfbe gcdfa fbcad dab cefabd cdfgeb eafb cagedb ab | cdfeb fcadb cdfeb cdbaf'],
            5353
        ];

//        yield [$this->getSampleInput(), 168];
//        yield [$this->getInput(), 95_581_659];
    }

    /**
     * @return string[]
     */
    private function getSampleInput(): array
    {
        $file = file(__DIR__ . '/sample.txt');

        \assert(\is_array($file));

        return array_map('trim', $file);
    }

    /**
     * @return int[]
     */
    protected function getInput(): array
    {
        $file = file(__DIR__ . '/input.txt');

        \assert(\is_array($file));

        return array_map('trim', $file);
    }

    protected function parseInput(array $input): array
    {
        $input = array_map(function (string $entry) {
            [$signalPatterns, $outputValues] = explode(' | ', $entry);

            return ['patterns' => explode(' ', $signalPatterns), 'values' => explode(' ', $outputValues)];
        }, $input);

        return $input;
    }
}

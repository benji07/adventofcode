<?php

declare(strict_types=1);

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
            1 => 2, 4 => 4, 7 => 3, 8 => 7,
        ];

        $input = $this->parseInput($input);

        $found = 0;

        foreach ($input as $entry) {
            foreach ($entry['values'] as $value) {
                if (\in_array(\strlen($value), $digits)) {
                    ++$found;
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
    public function testPart2Clean(array $input, int $expectedValue): void
    {
        $input = $this->parseInput($input);
        $patterns = array_column($input, 'patterns')[0];

        $letters = [];

        do {
            $nbPattern = count($patterns);
            foreach ($patterns as $i => $pattern) {
                $splitPattern = str_split($pattern);
                switch (strlen($pattern)) {
                    case 2: // 1
                        $digits[1] = $splitPattern;
                        unset($patterns[$i]);
                        break;
                    case 3: // 7
                        $digits[7] = $splitPattern;
                        unset($patterns[$i]);
                        break;
                    case 4: // 4
                        $digits[4] = $splitPattern;
                        unset($patterns[$i]);
                        break;
                    case 7: // 8
                        $digits[8] = $splitPattern;
                        unset($patterns[$i]);
                        break;
                    case 5: // 2, 3, 5
                        // 2

                        // 3
                        if (array_key_exists('middle', $letters) && array_key_exists('top', $letters) && array_key_exists(1, $digits)) {
                            $diff = array_diff($splitPattern, [$letters['top'], $letters['middle']], $digits[1]);
                            if (count($diff) === 1) {
                                $digits[3] = $splitPattern;

                                unset($patterns[$i]);
                            }
                        }

                        break;
                    case 6: // 0, 6, 9
                        // 6
                        if (array_key_exists(8, $digits) && array_key_exists(1, $digits)) {
                            $diff = array_intersect(array_diff($digits[8], $splitPattern), $digits[1]);
                            if (count($diff)) {
                                $letters['top-right'] = current($diff);
                                $digits[6] = $splitPattern;
//                                unset($patterns[$i]);
                            }
                        }

                        // 9
                        if (array_key_exists(4, $digits) && array_key_exists(7, $digits)) {
                            $merge = array_unique(array_merge($digits[4], $digits[7]));
                            $diff = array_diff($splitPattern, $merge);
                            if (count($diff) === 1) {
                                $letters['bottom-left'] = current($diff);
                                $digits[9] = $splitPattern;
                                unset($patterns[$i]);
                            }
                        }

                        if (array_key_exists(6, $digits) && array_key_exists(9, $digits)) {
                            $digits[0] = $splitPattern;
                            unset($patterns[$i]);
                        }

                        break;
                }
            }

            if (array_key_exists(7, $digits) && array_key_exists(1, $digits)) {
                $letters['top'] = current(array_diff($digits[7], $digits[1]));
            }

            if (array_key_exists(8, $digits) && array_key_exists(0, $digits)) {
                $letters['middle'] = current(array_diff($digits[8], $digits[0]));
            }

            if (array_key_exists(3, $digits) && array_key_exists(1, $digits) && array_key_exists('top', $letters) && array_key_exists('middle', $letters)) {
                $letters['bottom'] = current(array_diff($digits[3], $digits[1], [$letters['top'], $letters['middle']]));
            }

            if (array_key_exists('top-right', $letters) && array_key_exists(1, $digits)) {
                $letters['bottom-right'] = current(array_diff($digits[1], [$letters['top-right']]));
            }

            if ($nbPattern === count($patterns)) {
                var_dump($patterns, $letters, array_keys($digits));
                exit();
            }
        } while (count($patterns));
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
var_dump($patterns);
        foreach ($patterns as $i => $pattern) {
            switch (\strlen($pattern)) {
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
            'top' => current(array_diff($digits[7], $digits[1])),
            'top-right' => [],
            'top-left' => [],
            'middle' => [],
            'bottom-right' => [],
            'bottom-left' => [],
            'bottom' => [],
        ];

        foreach ($patterns as $i => $pattern) {
            switch (\strlen($pattern)) {
                case 5: // 2, 3, 5
                    break;
                case 6:
                    $letter = current(array_diff($digits[8], str_split($pattern)));

                    if (!\in_array($letter, $digits[1])) {
                        $digits[0] = str_split($pattern);
                        $letters['middle'] = $letter;

                        unset($patterns[$i]);
                    }
                    // possible digits = 0, 6, 9
                    break;
            }
        }

        foreach ($patterns as $i => $pattern) {
            $diff = array_diff(str_split($pattern), [$letters['top'], $letters['middle']], $digits[1]);
            if (count($diff) === 1) {
                $letters['bottom'] = current($diff);
                $digits[3] = str_split($pattern);
                unset($patterns[$i]);
            }
        }

        var_dump($patterns, array_keys($digits));

        foreach ($patterns as $i => $pattern) {
            $diff = array_diff(str_split($pattern), [$letters['top'], $letters['middle'], $letters['bottom']], $digits[1]);
            var_dump($diff);
        }

        // 2, 5, 6, 9
//        var_dump($digits, $letters, $patterns);

        exit();

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
            5353,
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

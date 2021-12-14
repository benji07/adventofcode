<?php

declare(strict_types=1);

namespace AOC2021\Day14;

use PHPUnit\Framework\TestCase;

class Day14Test extends TestCase
{
    /**
     * @dataProvider provideTestPart1
     */
    public function testPart1(string $input, int $expectedResult): void
    {
        [$polymer, $rules] = $this->extract($input);

        for ($i = 0; $i < 10; ++$i) {
            $resultPolymer = $polymer[0];
            $length = \strlen($polymer);
            for ($l = 1; $l < $length; ++$l) {
                $pair = substr($polymer, $l - 1, 2);
                $resultPolymer .= $rules[$pair] . $polymer[$l];
            }
            $polymer = $resultPolymer;
        }

        $values = array_count_values(str_split($polymer));

        self::assertEquals($expectedResult, max($values) - min($values));
    }

    /**
     * @return iterable<array{string, int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [$this->getInput('sample.txt'), 1_588];
        yield 'input' => [$this->getInput('input.txt'), 3_306];
    }

    /**
     * @dataProvider provideTestPart2
     */
    public function testPart2(string $input, int $expectedResult): void
    {
        [$polymer, $rules] = $this->extract($input);

        $pairs = [];
        $length = \strlen($polymer);
        for ($l = 1; $l < $length; ++$l) {
            $pair = substr($polymer, $l - 1, 2);

            $pairs[$pair] = ($pairs[$pair] ?? 0) + 1;
        }

        for ($i = 0; $i < 40; ++$i) {
            $newPairs = [];
            foreach ($pairs as $pair => $nb) {
                foreach ([$pair[0] . $rules[$pair], $rules[$pair] . $pair[1]] as $p) {
                    $newPairs[$p] = ($newPairs[$p] ?? 0) + $nb;
                }
            }
            $pairs = $newPairs;
        }

        $result = [];
        foreach ($pairs as $pair => $nb) {
            foreach (str_split($pair) as $char) {
                $result[$char] = ($result[$char] ?? 0) + $nb / 2;
            }
        }

        self::assertEquals($expectedResult, ceil(max($result) - min($result)));
    }

    /**
     * @return iterable<array{string, int}>
     */
    public function provideTestPart2(): iterable
    {
        yield 'sample' => [$this->getInput('sample.txt'), 2_188_189_693_529];
        yield 'input' => [$this->getInput('input.txt'), 3_760_312_702_877];
    }

    protected function getInput(string $filename): string
    {
        return trim((string) file_get_contents(__DIR__ . '/' . $filename));
    }

    /**
     * @return array{string, array<string, string>}
     */
    protected function extract(string $input): array
    {
        [$polymer, $rules] = explode("\n\n", $input);

        $rules = array_column(
            array_map(
                function (string $rule) {
                    return explode(' -> ', $rule);
                },
                explode("\n", $rules)
            ),
            1,
            0
        );

        return [$polymer, $rules];
    }
}

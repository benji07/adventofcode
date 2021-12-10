<?php

declare(strict_types=1);

namespace AOC2021\Day10;

use PHPUnit\Framework\TestCase;

class Day10Test extends TestCase
{
    /**
     * @param string[][] $input
     *
     * @dataProvider provideTestPart1
     */
    public function testPart1(array $input, int $expectedResult): void
    {
        $invalidCharFounds = [];
        $matching = [
            ')' => '(',
            ']' => '[',
            '>' => '<',
            '}' => '{',
        ];

        foreach ($input as $line) {
            $parsed = [];
            foreach ($line as $item) {
                switch ($item) {
                    case '(':
                    case '[':
                    case '<':
                    case '{':
                        $parsed[] = $item;
                        break;
                    default:
                        if (end($parsed) === $matching[$item]) {
                            array_pop($parsed);
                        } else {
                            $invalidCharFounds[] = $item;

                            break 2;
                        }
                        break;
                }
            }
        }

        $score = array_map(static function ($value) {
            return match ($value) {
                ')' => 3,
                ']' => 57,
                '}' => 1197,
                '>' => 25137,
                default => throw new \InvalidArgumentException(sprintf('unexepected char %s', $value)),
            };
        }, $invalidCharFounds);

        self::assertEquals($expectedResult, array_sum($score));
    }

    /**
     * @return iterable<array{string[][], int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [$this->getSampleInput(), 26_397];
        yield 'input' => [$this->getInput(), 311_949];
    }

    /**
     * @param string[][] $input
     *
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, int $expectedResult): void
    {
        $matching = [
            ')' => '(',
            ']' => '[',
            '>' => '<',
            '}' => '{',
        ];

        $notCorruptedLines = array_values(array_filter($input, static function ($line) use ($matching) {
            $parsed = [];
            foreach ($line as $item) {
                switch ($item) {
                    case '(':
                    case '[':
                    case '<':
                    case '{':
                        $parsed[] = $item;
                        break;
                    default:
                        if (end($parsed) !== $matching[$item]) {
                            return false;
                        }

                        array_pop($parsed);

                        break;
                }
            }

            return true;
        }));

        $charsToAdd = [];
        foreach ($notCorruptedLines as $i => $line) {
            $parsed = [];
            foreach ($line as $item) {
                switch ($item) {
                    case '(':
                    case '[':
                    case '<':
                    case '{':
                        $parsed[] = $item;
                        break;
                    default:
                        array_pop($parsed);
                        break;
                }
            }

            $charsToAdd[$i] = [];

            foreach (array_reverse($parsed) as $item) {
                $charsToAdd[$i][] = array_flip($matching)[$item];
            }
        }

        $scores = array_map(fn ($chars) => $this->getScore($chars), $charsToAdd);
        sort($scores);

        self::assertEquals($expectedResult, $scores[floor(\count($scores) / 2)]);
    }

    /**
     * @param string[] $chars
     */
    private function getScore(array $chars): int
    {
        $score = 0;
        foreach ($chars as $char) {
            $score *= 5;
            $score += match ($char) {
                ')' => 1,
                ']' => 2,
                '}' => 3,
                '>' => 4,
                default => 0,
            };
        }

        return $score;
    }

    /**
     * @return iterable<array{string[][], int}>
     */
    public function provideTestPart2(): iterable
    {
        yield [$this->getSampleInput(), 288_957];
        yield [$this->getInput(), 3_042_730_309];
    }

    /**
     * @return string[][]
     */
    private function getSampleInput(): array
    {
        $file = file(__DIR__ . '/sample.txt');
        \assert($file !== false);

        return array_map(fn ($line) => str_split(trim($line)), $file);
    }

    /**
     * @return string[][]
     */
    protected function getInput(): array
    {
        $file = file(__DIR__ . '/input.txt');
        \assert($file !== false);

        return array_map(fn ($line) => str_split(trim($line)), $file);
    }
}

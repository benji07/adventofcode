<?php

declare(strict_types=1);

namespace AOC2021\Day01;

use PHPUnit\Framework\TestCase;

class Day02Test extends TestCase
{
    /**
     * @param string[] $input
     *
     * @dataProvider provideTestPart1
     */
    public function testPart1(array $input, int $expectedResult): void
    {
        [$position, $depth] = [0, 0];

        foreach ($input as $instruction) {
            sscanf($instruction, '%s %d', $direction, $value);

            [$position, $depth] = match ($direction) {
                'forward' => [$position + $value, $depth],
                'down' => [$position, $depth + $value],
                'up' => [$position, $depth - $value],
                default => throw new \RuntimeException(),
            };
        }

        self::assertEquals($expectedResult, $position * $depth);
    }

    /**
     * @return iterable<array{string[], int}>
     */
    public function provideTestPart1(): iterable
    {
        yield [$this->getSampleInput(), 150];
        yield [$this->getInput(), 2_039_912];
    }

    /**
     * @param string[] $input
     *
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, int $expectedResult): void
    {
        [$position, $depth, $aim] = [0, 0, 0];

        foreach ($input as $instruction) {
            sscanf($instruction, '%s %d', $direction, $value);

            [$position, $depth, $aim] = match ($direction) {
                'forward' => [$position + $value, $depth + $aim * $value, $aim],
                'down' => [$position, $depth, $aim + $value],
                'up' => [$position, $depth, $aim - $value],
                default => throw new \RuntimeException(),
            };
        }

        self::assertEquals($expectedResult, $position * $depth);
    }

    /**
     * @return iterable<array{string[], int}>
     */
    public function provideTestPart2(): iterable
    {
        yield [$this->getSampleInput(), 900];
        yield [$this->getInput(), 1_942_068_080];
    }

    /**
     * @return string[]
     */
    private function getSampleInput(): array
    {
        return [
            'forward 5',
            'down 5',
            'forward 8',
            'up 3',
            'down 8',
            'forward 2',
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

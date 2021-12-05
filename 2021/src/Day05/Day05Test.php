<?php

declare(strict_types=1);

namespace AOC2021\Day05;

use PHPUnit\Framework\TestCase;

class Day05Test extends TestCase
{
    /**
     * @param string[] $input
     *
     * @dataProvider provideTestPart1
     */
    public function testPart1(array $input, int $expectedResult): void
    {
        $input = array_map(fn ($line) => Line::fromString($line), $input);

        $vents = [];
        foreach ($input as $line) {
            if ($line->isDiagonal()) {
                continue;
            }

            foreach ($line->getPoints() as $point) {
                $index = (string) $point;
                if (!\array_key_exists($index, $vents)) {
                    $vents[$index] = 0;
                }
                ++$vents[$index];
            }
        }

        $vents = array_filter($vents, fn ($value) => $value >= 2);

        self::assertCount($expectedResult, $vents);
    }

    /**
     * @return iterable<array{string[], int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [$this->getSampleInput(), 5];
        yield 'input' => [$this->getInput(), 8_111];
    }

    /**
     * @param string[] $input
     *
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, int $expectedResult): void
    {
        $input = array_map(fn ($line) => Line::fromString($line), $input);

        $vents = [];
        foreach ($input as $line) {
            foreach ($line->getPoints() as $point) {
                $index = (string) $point;
                if (!\array_key_exists($index, $vents)) {
                    $vents[$index] = 0;
                }
                ++$vents[$index];
            }
        }

        $vents = array_filter($vents, fn ($value) => $value >= 2);

        self::assertCount($expectedResult, $vents);
    }

    /**
     * @return iterable<array{string[], int}>
     */
    public function provideTestPart2(): iterable
    {
        yield [$this->getSampleInput(), 12];
        yield [$this->getInput(), 22_088];
    }

    /**
     * @param Point[] $expectedPoints
     *
     * @dataProvider provideTestGetPoints
     */
    public function testGetPoints(Line $line, array $expectedPoints): void
    {
        self::assertEquals($expectedPoints, iterator_to_array($line->getPoints()));
    }

    /**
     * @return iterable<array{Line, Point[]}>
     */
    public function provideTestGetPoints(): iterable
    {
        yield '1,1 -> 3,3' => [
            new Line(new Point(1, 1), new Point(3, 3)),
            [
                new Point(1, 1),
                new Point(2, 2),
                new Point(3, 3),
            ],
        ];

        yield '9,7 -> 7,9' => [
            new Line(new Point(9, 7), new Point(7, 9)),
            [
                new Point(9, 7),
                new Point(8, 8),
                new Point(7, 9),
            ],
        ];
    }

    /**
     * @return string[]
     */
    private function getSampleInput(): array
    {
        return [
            '0,9 -> 5,9',
            '8,0 -> 0,8',
            '9,4 -> 3,4',
            '2,2 -> 2,1',
            '7,0 -> 7,4',
            '6,4 -> 2,0',
            '0,9 -> 2,9',
            '3,4 -> 1,4',
            '0,0 -> 8,8',
            '5,5 -> 8,2',
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

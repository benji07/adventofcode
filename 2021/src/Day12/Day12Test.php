<?php

declare(strict_types=1);

namespace AOC2021\Day12;

use PHPUnit\Framework\TestCase;

class Day12Test extends TestCase
{
    /**
     * @param array{string, string}[] $input
     *
     * @dataProvider provideTestPart1
     */
    public function testPart1(array $input, int $expectedResult): void
    {
        $tree = [];
        foreach ($input as [$from, $to]) {
            if ($from !== 'end' && $to !== 'start') {
                $tree[$from][] = $to;
            }

            if ($to !== 'end' && $from !== 'start') {
                $tree[$to][] = $from;
            }
        }

        $finalPaths = [];
        $this->walk($tree, 'start', [], $finalPaths);

        self::assertCount($expectedResult, $finalPaths);
    }

    /**
     * @param array<string, string[]> $tree
     * @param string[]                $path
     * @param string[][]              $finalPaths
     */
    public function walk(array $tree, string $from, array $path, array & $finalPaths): void
    {
        if ($from === 'end') {
            $finalPaths[] = array_merge($path, ['end']);

            return;
        }

        if (\in_array($from, $path) && $from === strtolower($from)) {
            return;
        }

        $path[] = $from;
        foreach ($tree[$from] as $to) {
            $this->walk($tree, $to, $path, $finalPaths);
        }
    }

    /**
     * @return iterable<array{array<int, string[]>, int}>
     */
    public function provideTestPart1(): iterable
    {
        yield [$this->getInput('tiny-sample.txt'), 10];
        yield [$this->getInput('sample.txt'), 19];
        yield [$this->getInput('large-sample.txt'), 226];
        yield [$this->getInput('input.txt'), 3_679];
    }

    /**
     * @param array{string, string}[] $input
     *
     * @dataProvider provideTestPart2
     */
    public function testPart2(array $input, int $expectedResult): void
    {
        $tree = [];
        foreach ($input as [$from, $to]) {
            if ($from !== 'end' && $to !== 'start') {
                $tree[$from][] = $to;
            }

            if ($to !== 'end' && $from !== 'start') {
                $tree[$to][] = $from;
            }
        }

        $finalPaths = [];
        $this->walk2($tree, 'start', [], $finalPaths);

        self::assertCount($expectedResult, $finalPaths);
    }

    /**
     * @param array<string, string[]> $tree
     * @param string[]                $path
     * @param string[][]              $finalPaths
     */
    public function walk2(array $tree, string $from, array $path, array & $finalPaths): void
    {
        if ($from === 'end') {
            $finalPaths[] = array_merge($path, ['end']);

            return;
        }

        if (\in_array($from, $path) && $from === strtolower($from)) {
            $toCheck = array_filter($path, function ($step) {
                return $step !== 'start' && $step === strtolower($step);
            });
            $toCheck = array_count_values($toCheck);
            if (array_sum($toCheck) > \count($toCheck)) {
                return;
            }
        }

        $path[] = $from;
        foreach ($tree[$from] as $to) {
            $this->walk2($tree, $to, $path, $finalPaths);
        }
    }

    /**
     * @return iterable<array{array<int, string[]>, int}>
     */
    public function provideTestPart2(): iterable
    {
        yield [$this->getInput('tiny-sample.txt'), 36];
        yield [$this->getInput('sample.txt'), 103];
        yield [$this->getInput('large-sample.txt'), 3509];
        yield [$this->getInput('input.txt'), 107_395];
    }

    /**
     * @return array<int, string[]>
     */
    protected function getInput(string $filename): array
    {
        $data = file(__DIR__ . '/' . $filename);

        \assert($data !== false);

        return array_map(fn (string $line) => explode('-', trim($line), 2), $data);
    }
}

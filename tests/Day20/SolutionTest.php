<?php

namespace AdventOfCode\Tests\Day20;

use AdventOfCode\Day20\EdgeFinder;
use AdventOfCode\Day20\Parser;
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    public function testSample1(): void
    {
        $tiles = (new Parser())->parse(trim(file_get_contents(__DIR__.'/sample.txt')));

        self::assertCount(9, $tiles);

        $edges = (new EdgeFinder())->find(...$tiles);

        self::assertEquals(array_product([1951, 3079, 2971, 1171]), array_product($edges));
    }

    public function testPart1(): void
    {
        $tiles = (new Parser())->parse(trim(file_get_contents(__DIR__.'/input.txt')));

        $edges = (new EdgeFinder())->find(...$tiles);

        self::assertEquals(79_412_832_860_579, array_product($edges));
    }
}

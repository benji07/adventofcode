<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day16;

use AdventOfCode\Day16\Solution;
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    public function testSample1(): void
    {
        $solution = new Solution(trim(file_get_contents(__DIR__ . '/sample.txt')));

        self::assertEquals(71, $solution->getPart1Solution());
    }

    public function testPart1(): void
    {
        $solution = new Solution(trim(file_get_contents(__DIR__ . '/input.txt')));

        self::assertEquals(27_850, $solution->getPart1Solution());
    }

    public function testSample2(): void
    {
        $solution = new Solution(trim(file_get_contents(__DIR__ . '/sample2.txt')));

        self::assertEquals(['class' => 12, 'row' => 11, 'seat' => 13], $solution->getMyTicketDetail());
    }

    public function testPart2(): void
    {
        $solution = new Solution(trim(file_get_contents(__DIR__ . '/input.txt')));

        self::assertEquals(491_924_517_533, $solution->getPart2Solution());
    }
}

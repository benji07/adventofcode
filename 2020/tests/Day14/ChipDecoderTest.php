<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day14;

use AdventOfCode\Day14\ChipDecoder;
use AdventOfCode\Day14\ChipDecoderV2;
use PHPUnit\Framework\TestCase;

class ChipDecoderTest extends TestCase
{
    public function testSample()
    {
        $input = <<<INPUT
mask = XXXXXXXXXXXXXXXXXXXXXXXXXXXXX1XXXX0X
mem[8] = 11
mem[7] = 101
mem[8] = 0
INPUT;

        $decoder = new ChipDecoder();
        $decoder->readAsArray(explode("\n", trim($input)));

        self::assertEquals(165, $decoder->getMemorySum());
    }

    public function testPart1(): void
    {
        $decoder = new ChipDecoder();
        $decoder->readAsArray(explode("\n", trim(file_get_contents(__DIR__ . '/input.txt'))));

        self::assertEquals(17_028_179_706_934, $decoder->getMemorySum());
    }

    public function testSample2()
    {
        $input = <<<INPUT
mask = 000000000000000000000000000000X1001X
mem[42] = 100
mask = 00000000000000000000000000000000X0XX
mem[26] = 1
INPUT;

        $decoder = new ChipDecoderV2();
        $decoder->readAsArray(explode("\n", trim($input)));

        self::assertEquals(208, $decoder->getMemorySum());
    }

    public function testPart2(): void
    {
        $decoder = new ChipDecoderV2();
        $decoder->readAsArray(explode("\n", trim(file_get_contents(__DIR__ . '/input.txt'))));

        self::assertEquals(3_683_236_147_222, $decoder->getMemorySum());
    }
}

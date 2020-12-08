<?php

namespace AdventOfCode\Tests\Day8;

use AdventOfCode\Day8\Runner;
use PHPUnit\Framework\TestCase;

class RunnerTest extends TestCase
{
    public function testSample1(): void
    {
        $input = <<<DATA
nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
jmp -4
acc +6
DATA;

        $runner = Runner::createFromString($input);

        $runner->run(true);

        self::assertEquals(5, $runner->accumulator);
    }

    public function testPart1(): void
    {
        $input = trim(file_get_contents(__DIR__.'/input.txt'));

        $runner = Runner::createFromString($input);

        $runner->run(true);

        self::assertEquals(1939, $runner->accumulator);
    }

    public function testSample2(): void
    {
        $input = <<<DATA
nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
jmp -4
acc +6
DATA;

        $runner = Runner::createFromString($input);

        self::assertEquals(8, $runner->mutate('nop', 'jmp'));
    }

    public function testPart2(): void
    {
        $input = trim(file_get_contents(__DIR__.'/input.txt'));

        $runner = Runner::createFromString($input);

        $runner->run(true);

        self::assertEquals(2212, $runner->mutate('nop', 'jmp'));
    }
}

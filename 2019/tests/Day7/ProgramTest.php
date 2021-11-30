<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day7;

use Benji07\AdventOfCode\Day7\Program;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
    /**
     * @param int[] $memory
     * @param int[] $phaseSettings
     *
     * @dataProvider provideTestGetThrusterSignal
     */
    public function testGetThrusterSignal(array $memory, array $phaseSettings, int $expectedThrusterSignal): void
    {
        $program = new Program($memory);
        $thrusterSignal = $program->getThrusterSignal($phaseSettings);

        $this->assertEquals($expectedThrusterSignal, $thrusterSignal);
    }

    public function provideTestGetThrusterSignal(): \Generator
    {
        yield [
            [3, 15, 3, 16, 1002, 16, 10, 16, 1, 16, 15, 15, 4, 15, 99, 0, 0],
            [4, 3, 2, 1, 0],
            43210,
        ];

        yield [
            [3, 23, 3, 24, 1002, 24, 10, 24, 1002, 23, -1, 23, 101, 5, 23, 23, 1, 24, 23, 23, 4, 23, 99, 0, 0],
            [0, 1, 2, 3, 4],
            54321,
        ];

        yield [
            [3, 31, 3, 32, 1002, 32, 10, 32, 1001, 31, -2, 31, 1007, 31, 0, 33, 1002, 33, 7, 33, 1, 33, 31, 31, 1, 32, 31, 31, 4, 31, 99, 0, 0, 0],
            [1, 0, 4, 3, 2],
            65210,
        ];
    }

    public function testPart1()
    {
        $program = new Program($this->getMemoryDump());
        $thrusterSignal = $program->getMaxThrusterSignal();

        $this->assertEquals(70597, $thrusterSignal);
    }

    /**
     * @param int[] $memory
     * @param int[] $phaseSettings
     *
     * @dataProvider provideTestGetThrusterSignalWithFeedbackLoop
     */
    public function testGetThrusterSignalWithFeedbackLoop(array $memory, array $phaseSettings, int $expectedThrusterSignal): void
    {
        $program = new Program($memory, true);
        $thrusterSignal = $program->getThrusterSignal($phaseSettings);

        $this->assertEquals($expectedThrusterSignal, $thrusterSignal);
    }

    public function provideTestGetThrusterSignalWithFeedbackLoop(): \Generator
    {
        yield [
            [3, 26, 1001, 26, -4, 26, 3, 27, 1002, 27, 2, 27, 1, 27, 26, 27, 4, 27, 1001, 28, -1, 28, 1005, 28, 6, 99, 0, 0, 5],
            [9, 8, 7, 6, 5],
            139629729,
        ];

        yield [
            [3, 52, 1001, 52, -5, 52, 3, 53, 1, 52, 56, 54, 1007, 54, 5, 55, 1005, 55, 26, 1001, 54,
                -5, 54, 1105, 1, 12, 1, 53, 54, 53, 1008, 54, 0, 55, 1001, 55, 1, 55, 2, 53, 55, 53, 4,
                53, 1001, 56, -1, 56, 1005, 56, 6, 99, 0, 0, 0, 0, 10, ],
            [9, 7, 8, 5, 6],
            18216,
        ];
    }

    public function testPart2()
    {
        $program = new Program($this->getMemoryDump());
        $thrusterSignal = $program->getMaxThrusterSignal(5, 9);

        $this->assertEquals(70597, $thrusterSignal);
    }

    /**
     * @return int[]
     */
    private function getMemoryDump(): array
    {
        $dump = file_get_contents(__DIR__ . '/data/input.txt');

        if ($dump === false) {
            $this->fail('Invalid file');

            return [];
        }

        return array_map('intval', explode(',', $dump));
    }
}

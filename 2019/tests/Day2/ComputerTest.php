<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day2;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use PHPUnit\Framework\TestCase;

class ComputerTest extends TestCase
{
    /**
     * @param int[] $input
     * @param int[] $expectedOutput
     *
     * @dataProvider provideTestResolve
     */
    public function testResolve(array $input, array $expectedOutput): void
    {
        $computer = new IntcodeComputer($input);
        $computer->resolve();

        $this->assertEquals(implode(',', $expectedOutput), implode(',', $computer->memory));
    }

    public function provideTestResolve()
    {
        yield [
            [1, 0, 0, 0, 99],
            [2, 0, 0, 0, 99],
        ];

        yield [
            [2, 3, 0, 3, 99],
            [2, 3, 0, 6, 99],
        ];

        yield [
            [2, 4, 4, 5, 99, 0],
            [2, 4, 4, 5, 99, 9801],
        ];

        yield [
            [1, 1, 1, 4, 99, 5, 6, 0, 99],
            [30, 1, 1, 4, 2, 5, 6, 0, 99],
        ];
    }

    public function testPart1(): void
    {
        $memory = $this->getMemoryDump();

        $computer = new IntcodeComputer($memory);

        $noun = 12;
        $verb = 2;

        $computer->resolve($noun, $verb);

        $this->assertEquals(3_409_710, $computer->memory[0]);
    }

    public function testFindInput(): void
    {
        $memory = $this->getMemoryDump();

        $computer = new IntcodeComputer($memory);
        [$noun, $verb] = $computer->findInput(3_409_710);

        $this->assertEquals(12, $noun);
        $this->assertEquals(2, $verb);
    }

    public function testPart2(): void
    {
        $memory = $this->getMemoryDump();

        $computer = new IntcodeComputer($memory);
        [$noun, $verb] = $computer->findInput(19_690_720);

        $this->assertEquals(79, $noun);
        $this->assertEquals(12, $verb);

        $this->assertEquals(7912, $noun * 100 + $verb);
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

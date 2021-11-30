<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day3;

use Benji07\AdventOfCode\Day3\Grid;
use Benji07\AdventOfCode\Day3\Point;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function testAddWire(): void
    {
        $grid = new Grid();
        $grid->addWire(1, ['R8', 'U5', 'L5', 'D3']);
        $grid->addWire(2, ['U7', 'R6', 'D4', 'L4']);

        $intersections = $grid->getIntersections();

        $this->assertCount(2, $intersections);

        $this->assertEquals([new Point(6, -5), new Point(3, -3)], $intersections);
    }

    public function testAddWireSimple(): void
    {
        $grid = new Grid();
        $grid->addWire(1, ['R8']);

        $expectedGrid = [
            1 => [
                new Point(1, 0),
                new Point(2, 0),
                new Point(3, 0),
                new Point(4, 0),
                new Point(5, 0),
                new Point(6, 0),
                new Point(7, 0),
                new Point(8, 0),
            ],
        ];

        $this->assertEquals($expectedGrid, $grid->getGrid());
    }

    public function testAddWireSimpleMulti(): void
    {
        $grid = new Grid();
        $grid->addWire(1, ['R2', 'U2']);

        $expectedGrid = [
            1 => [
                new Point(1, 0),
                new Point(2, 0),
                new Point(2, -1),
                new Point(2, -2),
            ],
        ];

        $this->assertEquals($expectedGrid, $grid->getGrid());
    }

    /**
     * @param string[][] $wires
     *
     * @dataProvider provideTestDistance
     */
    public function testDistance(array $wires, int $distance): void
    {
        $grid = new Grid();

        foreach ($wires as $i => $wire) {
            $grid->addWire($i, $wire);
        }

        $this->assertEquals($distance, $grid->getManhattanDistance());
    }

    public function provideTestDistance(): \Generator
    {
        yield [
            [
                ['R75', 'D30', 'R83', 'U83', 'L12', 'D49', 'R71', 'U7', 'L72'],
                ['U62', 'R66', 'U55', 'R34', 'D71', 'R55', 'D58', 'R83'],
            ],
            159,
        ];

        yield [
            [
                ['R98', 'U47', 'R26', 'D63', 'R33', 'U87', 'L62', 'D20', 'R33', 'U53', 'R51'],
                ['U98', 'R91', 'D20', 'R16', 'D67', 'R40', 'U7', 'R15', 'U6', 'R7'],
            ],
            135,
        ];
    }

    public function testPart1(): void
    {
        $grid = new Grid();

        $data = $this->getInput();

        foreach ($data as $i => $wire) {
            $grid->addWire($i, $wire);
        }

        $this->assertEquals(4981, $grid->getManhattanDistance());
    }

    /**
     * @return string[][]
     */
    private function getInput(): array
    {
        $data = file(__DIR__ . '/data/input.txt');
        if ($data === false) {
            $this->fail('Invalid file');

            return [];
        }

        return array_map(function (string $wire) {
            return explode(',', $wire);
        }, $data);
    }

    public function testGetStep(): void
    {
        $inputs = [
            ['R8', 'U5', 'L5', 'D3'],
            ['U7', 'R6', 'D4', 'L4'],
        ];

        $grid = new Grid();
        foreach ($inputs as $i => $wire) {
            $grid->addWire($i, $wire);
        }

        $this->assertEquals(30, $grid->getSteps(new Point(6, -5)));
        $this->assertEquals(40, $grid->getSteps(new Point(3, -3)));
    }

    /**
     * @dataProvider provideTestGetLowestStep
     */
    public function testGetLowestStep(array $inputs, int $steps): void
    {
        $grid = new Grid();
        foreach ($inputs as $i => $wire) {
            $grid->addWire($i, $wire);
        }

        $this->assertEquals($steps, $grid->getLowestSteps());
    }

    public function provideTestGetLowestStep(): \Generator
    {
        yield [
            [
                ['R8', 'U5', 'L5', 'D3'],
                ['U7', 'R6', 'D4', 'L4'],
            ],
            30,
        ];

        yield [
            [
                ['R75', 'D30', 'R83', 'U83', 'L12', 'D49', 'R71', 'U7', 'L72'],
                ['U62', 'R66', 'U55', 'R34', 'D71', 'R55', 'D58', 'R83'],
            ],
            610,
        ];

        yield [
            [
                ['R98', 'U47', 'R26', 'D63', 'R33', 'U87', 'L62', 'D20', 'R33', 'U53', 'R51'],
                ['U98', 'R91', 'D20', 'R16', 'D67', 'R40', 'U7', 'R15', 'U6', 'R7'],
            ],
            410,
        ];
    }

    public function testPart2(): void
    {
        $grid = new Grid();
        $data = $this->getInput();
        foreach ($data as $i => $wire) {
            $grid->addWire($i, $wire);
        }

        $this->assertEquals(164_012, $grid->getLowestSteps());
    }
}

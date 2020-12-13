<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day12;

use AdventOfCode\Day12\Position;
use AdventOfCode\Day12\Ship;
use AdventOfCode\Day12\ShipWithWaypoint;
use PHPUnit\Framework\TestCase;

class ShipTest extends TestCase
{
    public function testSample1(): void
    {
        $ship = new Ship(new Position(0, 0));

        $instructions = [
            ['action' => 'F', 'value' => 10, 'expectedPosition' => new Position(10, 0), 'orientation' => 0],
            ['action' => 'N', 'value' => 3, 'expectedPosition' => new Position(10, 3), 'orientation' => 0],
            ['action' => 'F', 'value' => 7, 'expectedPosition' => new Position(17, 3), 'orientation' => 0],
            ['action' => 'R', 'value' => 90, 'expectedPosition' => new Position(17, 3), 'orientation' => 90],
            ['action' => 'F', 'value' => 11, 'expectedPosition' => new Position(17, -8), 'orientation' => 90],
        ];

        foreach ($instructions as $instruction) {
            $ship->move($instruction['action'], $instruction['value']);

            self::assertEquals($instruction['expectedPosition'], $ship->position);
            self::assertEquals($instruction['orientation'], $ship->angle);
        }

        self::assertEquals(25, $ship->getDistance());
    }

    public function testPart1(): void
    {
        $instructions = explode("\n", trim(file_get_contents(__DIR__ . '/input.txt')));

        $ship = new Ship(new Position(0, 0));
        foreach ($instructions as $instruction) {
            $ship->move($instruction[0], (int) substr($instruction, 1));
        }

        self::assertEquals(1133, $ship->getDistance());
    }

    public function testSample2(): void
    {
        $ship = new ShipWithWaypoint(new Position(0, 0), new Position(10, 1));

        $instructions = [
            ['action' => 'F', 'value' => 10, 'expectedPosition' => new Position(100, 10), 'waypoint' => new Position(10, 1)],
            ['action' => 'N', 'value' => 3, 'expectedPosition' => new Position(100, 10), 'waypoint' => new Position(10, 4)],
            ['action' => 'F', 'value' => 7, 'expectedPosition' => new Position(170, 38), 'waypoint' => new Position(10, 4)],
            ['action' => 'R', 'value' => 90, 'expectedPosition' => new Position(170, 38), 'waypoint' => new Position(4, -10)],
            ['action' => 'F', 'value' => 11, 'expectedPosition' => new Position(214, -72), 'waypoint' => new Position(4, -10)],
        ];

        foreach ($instructions as $instruction) {
            $ship->move($instruction['action'], $instruction['value']);

            self::assertEquals($instruction['expectedPosition'], $ship->position);
            self::assertEquals($instruction['waypoint'], $ship->waypoint);
        }

        self::assertEquals(286, $ship->getDistance());
    }

    public function testPart2(): void
    {
        $instructions = explode("\n", trim(file_get_contents(__DIR__ . '/input.txt')));

        $ship = new ShipWithWaypoint(new Position(0, 0), new Position(10, 1));
        foreach ($instructions as $instruction) {
            $ship->move($instruction[0], (int) substr($instruction, 1));
        }

        self::assertEquals(61_053, $ship->getDistance());
    }
}

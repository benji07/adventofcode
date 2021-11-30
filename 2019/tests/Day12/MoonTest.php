<?php

namespace Benji07\AdventOfCode\Tests\Day12;

use Benji07\AdventOfCode\Day12\Moon;
use Benji07\AdventOfCode\Day12\Position;
use Benji07\AdventOfCode\Day12\Velocity;
use PHPUnit\Framework\TestCase;

class MoonTest extends TestCase
{
    public function testApplyGravityFrom()
    {
        $ganymede = new Moon(new Position(3,0,0));
        $callisto = new Moon(new Position(5,0,0));

        $ganymede->applyGravityFrom($callisto);
        $callisto->applyGravityFrom($ganymede);

        $this->assertEquals(1, $ganymede->velocity->x);
        $this->assertEquals(-1, $callisto->velocity->x);
    }

    public function testMove()
    {
        $europa = new Moon(new Position(1, 2, 3), new Velocity(-2, 0, 3));
        $europa->move();

        $this->assertEquals(-1, $europa->position->x);
        $this->assertEquals(2, $europa->position->y);
        $this->assertEquals(6, $europa->position->z);
    }
}

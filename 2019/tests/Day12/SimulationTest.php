<?php

namespace Benji07\AdventOfCode\Tests\Day12;

use Benji07\AdventOfCode\Day12\Moon;
use Benji07\AdventOfCode\Day12\Position;
use Benji07\AdventOfCode\Day12\Simulation;
use Benji07\AdventOfCode\Day12\Velocity;
use PHPUnit\Framework\TestCase;

class SimulationTest extends TestCase
{

    public function testStep()
    {
        $simulation = new Simulation(
            new Moon(new Position(-1, 0, 2)),
            new Moon(new Position(2, -10, -7)),
            new Moon(new Position(4, -8, 8)),
            new Moon(new Position(3, 5, -1))
        );

        $steps = [
            [
                [[-1, 0, 2], [0, 0, 0]],
                [[2, -10, -7], [0, 0, 0]],
                [[4, -8, 8], [0, 0, 0]],
                [[3, 5, -1], [0, 0, 0]],
            ],
            [
                [[2, -1, 1], [3, -1, -1]],
                [[3, -7, -4], [1, 3, 3]],
                [[1, -7, 5], [-3, 1, -3]],
                [[2, 2, 0], [-1, -3, 1]],
            ],
            [
                [[5, -3, -1], [3, -2, -2]],
                [[1, -2, 2], [-2, 5, 6]],
                [[1, -4, -1], [0, 3, -6]],
                [[1, -4, 2], [-1, -6, 2]],
            ],
            [
                [[5, -6, -1], [0, -3, 0]],
                [[0, 0, 6], [-1, 2, 4]],
                [[2, 1, -5], [1, 5, -4]],
                [[1, -8, 2], [0, -4, 0]],
            ],
            [
                [[2, -8, 0], [-3, -2, 1]],
                [[2, 1, 7], [2, 1, 1]],
                [[2, 3, -6], [0, 2, -1]],
                [[2, -9, 1], [1, -1, -1]],
            ],
            [
                [[-1, -9, 2], [-3, -1, 2]],
                [[4, 1, 5], [2, 0, -2]],
                [[2, 2, -4], [0, -1, 2]],
                [[3, -7, -1], [1, 2, -2]],
            ],
            [
                [[-1, -7, 3], [0, 2, 1]],
                [[3, 0, 0], [-1, -1, -5]],
                [[3, -2, 1], [1, -4, 5]],
                [[3, -4, -2], [0, 3, -1]],
            ],
            [
                [[2, -2, 1], [3, 5, -2]],
                [[1, -4, -4], [-2, -4, -4]],
                [[3, -7, 5], [0, -5, 4]],
                [[2, 0, 0], [-1, 4, 2]],
            ],
            [
                [[5, 2, -2], [3, 4, -3]],
                [[2, -7, -5], [1, -3, -1]],
                [[0, -9, 6], [-3, -2, 1]],
                [[1, 1, 3], [-1, 1, 3]],
            ],
            [
                [[5, 3, -4], [0, 1, -2]],
                [[2, -9, -3], [0, -2, 2]],
                [[0, -8, 4], [0, 1, -2]],
                [[1, 1, 5], [0, 0, 2]],
            ],
            [
                [[2, 1, -3], [-3, -2, 1]],
                [[1, -8, 0], [-1, 1, 3]],
                [[3, -6, 1], [3, 2, -3]],
                [[2, 0, 4], [1, -1, -1]],
            ],
        ];

        foreach ($steps as $step) {
            foreach ($simulation->moons as $i => $moon) {
                $this->assertEquals($step[$i][0][0], $moon->position->x);
                $this->assertEquals($step[$i][0][1], $moon->position->y);
                $this->assertEquals($step[$i][0][2], $moon->position->z);
                $this->assertEquals($step[$i][1][0], $moon->velocity->x);
                $this->assertEquals($step[$i][1][1], $moon->velocity->y);
                $this->assertEquals($step[$i][1][2], $moon->velocity->z);
            }

            $simulation->step();
        }
    }

    public function testEnergy()
    {
        $simulation = new Simulation(
            new Moon(new Position(-1, 0, 2)),
            new Moon(new Position(2, -10, -7)),
            new Moon(new Position(4, -8, 8)),
            new Moon(new Position(3, 5, -1))
        );

        $simulation->run(10);

        $this->assertEquals(6, $simulation->moons[0]->getPotentialEnergy());
        $this->assertEquals(6, $simulation->moons[0]->getKineticEnergy());
        $this->assertEquals(36, $simulation->moons[0]->getTotalEnergy());

        $this->assertEquals(9, $simulation->moons[1]->getPotentialEnergy());
        $this->assertEquals(5, $simulation->moons[1]->getKineticEnergy());
        $this->assertEquals(45, $simulation->moons[1]->getTotalEnergy());

        $this->assertEquals(10, $simulation->moons[2]->getPotentialEnergy());
        $this->assertEquals(8, $simulation->moons[2]->getKineticEnergy());
        $this->assertEquals(80, $simulation->moons[2]->getTotalEnergy());

        $this->assertEquals(6, $simulation->moons[3]->getPotentialEnergy());
        $this->assertEquals(3, $simulation->moons[3]->getKineticEnergy());
        $this->assertEquals(18, $simulation->moons[3]->getTotalEnergy());

        $this->assertEquals(179, $simulation->getTotalEnergy());
    }

    public function testPart1()
    {
        $simulation = new Simulation(
            new Moon(new Position(4, 1, 1)),
            new Moon(new Position(11, -18, -1)),
            new Moon(new Position(-2, -10, -4)),
            new Moon(new Position(-7, -2, 14))
        );

        $simulation->run(1000);

        $this->assertEquals(9493, $simulation->getTotalEnergy());
    }

    public function testReachInitialPosition()
    {
        $simulation = new Simulation(
            new Moon(new Position(-1, 0, 2)),
            new Moon(new Position(2, -10, -7)),
            new Moon(new Position(4, -8, 8)),
            new Moon(new Position(3, 5, -1))
        );

        $this->assertEquals(2772, $simulation->stepNeededToReachInitialStep());
    }

    public function testReachInitialPosition2()
    {
        $simulation = new Simulation(
            new Moon(new Position(-8, -10, 0)),
            new Moon(new Position(5, 5, 10)),
            new Moon(new Position(2, -7, 3)),
            new Moon(new Position(9, -8, -3))
        );

//        $this->assertEquals(4_686_774_924, $simulation->stepNeededToReachInitialStep());
    }

    public function testPart2()
    {
        $simulation = new Simulation(
            new Moon(new Position(4, 1, 1)),
            new Moon(new Position(11, -18, -1)),
            new Moon(new Position(-2, -10, -4)),
            new Moon(new Position(-7, -2, 14))
        );

//        $this->assertEquals(0, $simulation->stepNeededToReachInitialStep());
    }
}

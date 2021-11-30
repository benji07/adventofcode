<?php

namespace Benji07\AdventOfCode\Day12;

class Simulation
{
    /** @var Moon[] */
    public array $moons;

    public function __construct(Moon ...$moons)
    {
        $this->moons = $moons;
    }

    public function run(int $step): void
    {
        for ($i = 0; $i < $step; $i++) {
            $this->step();
        }
    }

    public function step(): void
    {
        $pairs = [];
        foreach ($this->moons as $j => $moonA) {
            foreach ($this->moons as $k => $moonB) {
                if ($j === $k) {
                    continue;
                }

                if (in_array($j . ';' . $k, $pairs)) {
                    continue;
                }

                $moonA->applyGravityFrom($moonB);

                $pairs[] = $j . ';' . $k;
            }
        }

        foreach ($this->moons as $moon) {
            $moon->move();
        }
    }

    public function stepNeededToReachInitialStep(): int
    {
        $initial = (string) $this;
        $energy = $this->getPotentialEnergy();
        $step = 0;
        do {
            $step++;
            $this->step();
        } while ((string) $this !== $initial);

        return $step;
    }

    public function getTotalEnergy(): int
    {
        return array_sum(array_map(function (Moon $moon) {
            return $moon->getTotalEnergy();
        }, $this->moons));
    }

    public function getKineticEnergy(): int
    {
        return array_sum(array_map(function (Moon $moon) {
            return $moon->getKineticEnergy();
        }, $this->moons));
    }

    public function getPotentialEnergy(): int
    {
        return array_sum(array_map(function (Moon $moon) {
            return $moon->getPotentialEnergy();
        }, $this->moons));
    }

    public function __toString(): string
    {
        return implode(',\n',array_map('strval', $this->moons));
    }
}

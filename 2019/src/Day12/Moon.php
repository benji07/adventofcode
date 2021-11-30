<?php

namespace Benji07\AdventOfCode\Day12;

class Moon
{
    public Position $position;

    public Velocity $velocity;

    public function __construct(Position $position, ?Velocity $velocity = null)
    {
        $this->position = $position;
        $this->velocity = $velocity ?? new Velocity(0, 0, 0);
    }

    public function applyGravityFrom(Moon $moon): void
    {
        if ($this->position->x > $moon->position->x) {
            $this->velocity->x--;
        }

        if ($this->position->x < $moon->position->x) {
            $this->velocity->x++;
        }

        if ($this->position->y > $moon->position->y) {
            $this->velocity->y--;
        }

        if ($this->position->y < $moon->position->y) {
            $this->velocity->y++;
        }

        if ($this->position->z > $moon->position->z) {
            $this->velocity->z--;
        }

        if ($this->position->z < $moon->position->z) {
            $this->velocity->z++;
        }
    }

    public function move(): void
    {
        $this->position->x += $this->velocity->x;
        $this->position->y += $this->velocity->y;
        $this->position->z += $this->velocity->z;
    }

    public function getPotentialEnergy(): int
    {
        return abs($this->position->x) + abs($this->position->y) + abs($this->position->z);
    }

    public function getKineticEnergy(): int
    {
        return abs($this->velocity->x) + abs($this->velocity->y) + abs($this->velocity->z);
    }

    public function getTotalEnergy(): int
    {
        return $this->getPotentialEnergy() * $this->getKineticEnergy();
    }

    public function __toString()
    {
        return "[{$this->position},{$this->velocity}]";
    }
}

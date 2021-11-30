<?php

namespace AdventOfCode\Day12;

class ShipWithWaypoint
{
    private int $angle;

    public function __construct(public Position $position, public Position $waypoint)
    {
        $this->angle = 0;
    }

    public function move(string $action, int $value): void
    {
        switch ($action) {
            case Ship::ACTION_ROTATE_LEFT:
                $this->rotateLeft($value);
                break;
            case Ship::ACTION_ROTATE_RIGHT:
                $this->rotateRight($value);
                break;
            case Ship::ACTION_MOVE_EAST:
                $this->waypoint->x += $value;
                break;
            case Ship::ACTION_MOVE_WEST:
                $this->waypoint->x -= $value;
                break;
            case Ship::ACTION_MOVE_NORTH:
                $this->waypoint->y += $value;
                break;
            case Ship::ACTION_MOVE_SOUTH:
                $this->waypoint->y -= $value;
                break;
            case Ship::ACTION_MOVE_FORWARD:
                $this->position->x += $this->waypoint->x * $value;
                $this->position->y += $this->waypoint->y * $value;
                break;
        }
    }

    protected function rotate(int $newAngle): void
    {
        $x = $this->waypoint->x;
        $y = $this->waypoint->y;

        [$x, $y] = match ($this->angle) {
            90 => [-$y, $x], // 90 -> 0 = (x, y) -> (-y, x)
            180 => [-$x, -$y], // 180 -> 0 = (x, y) -> (-x, -y)
            270 => [$y, -$x], // 270 -> 0 = (x, y) -> (y, -x)
            default => [$x, $y]
        };

        [$x, $y] = match ($newAngle) {
            90 => [$y, -$x], // 0 -> 90 = (x, y) -> (y, -x)
            180 => [-$x, -$y], // 0 -> 180 = (x, y) -> (-x, -y)
            270 => [-$y, $x], // 0 -> 270 = (x, y) -> (-y, x)
            default => [$x, $y]
        };

        $this->waypoint->x = $x;
        $this->waypoint->y = $y;
    }

    public function rotateLeft(int $rotation): void
    {
        $newAngle = $this->angle - $rotation;
        if ($newAngle < 0) {
            $newAngle = 360 + $newAngle;
        }

        $this->rotate($newAngle);
    }

    public function rotateRight(int $rotation): void
    {
        $newAngle = $this->angle + $rotation;
        if ($newAngle >= 360) {
            $newAngle = $newAngle - 360;
        }

        $this->rotate($newAngle);
    }

    public function getDistance(): int
    {
        return abs($this->position->x) + abs($this->position->y);
    }
}

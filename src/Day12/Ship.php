<?php

declare(strict_types=1);

namespace AdventOfCode\Day12;

class Ship
{
    const ORIENTATION_EAST = 'E';
    const ORIENTATION_NORTH = 'N';
    const ORIENTATION_WEST = 'W';
    const ORIENTATION_SOUTH = 'S';

    const ACTION_ROTATE_LEFT = 'L';
    const ACTION_ROTATE_RIGHT = 'R';
    const ACTION_MOVE_EAST = 'E';
    const ACTION_MOVE_NORTH = 'N';
    const ACTION_MOVE_WEST = 'W';
    const ACTION_MOVE_SOUTH = 'S';
    const ACTION_MOVE_FORWARD = 'F';

    public int $angle = 0;

    public function __construct(public Position $position, public string $orientation = self::ORIENTATION_EAST)
    {
    }

    public function move(string $action, int $value): void
    {
        switch ($action) {
            case self::ACTION_ROTATE_LEFT:
                $this->angle -= $value;
                if ($this->angle < 0) {
                    $this->angle = 360 + $this->angle;
                }
                break;
            case self::ACTION_ROTATE_RIGHT:
                $this->angle += $value;
                if ($this->angle >= 360) {
                    $this->angle = $this->angle - 360;
                }
                break;
            case self::ACTION_MOVE_EAST:
                $this->position->x += $value;
                break;
            case self::ACTION_MOVE_SOUTH:
                $this->position->y -= $value;
                break;
            case self::ACTION_MOVE_WEST:
                $this->position->x -= $value;
                break;
            case self::ACTION_MOVE_NORTH:
                $this->position->y += $value;
                break;
            case self::ACTION_MOVE_FORWARD:
                switch ($this->angle) {
                    case 0:
                        $this->move(self::ACTION_MOVE_EAST, $value);
                        break;
                    case 90:
                        $this->move(self::ACTION_MOVE_SOUTH, $value);
                        break;
                    case 180:
                        $this->move(self::ACTION_MOVE_WEST, $value);
                        break;
                    case 270:
                        $this->move(self::ACTION_MOVE_NORTH, $value);
                        break;
                }
                break;
            default:
                // invalid
                break;
        }
    }

    public function getDistance(): int
    {
        return abs($this->position->x) + abs($this->position->y);
    }
}

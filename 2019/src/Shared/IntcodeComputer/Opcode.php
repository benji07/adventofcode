<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer;

class Opcode
{
    public const MODE_POSITION = 0;
    public const MODE_IMMEDIATE = 1;

    public const ACTION_ADD = 1;
    public const ACTION_MULTIPLY = 2;
    public const ACTION_INPUT = 3;
    public const ACTION_OUTPUT = 4;
    public const ACTION_JUMP_TRUE = 5;
    public const ACTION_JUMP_FALSE = 6;
    public const ACTION_LESS_THAN = 7;
    public const ACTION_EQUALS = 8;
    public const ACTION_END = 99;

    private string $value;

    /** @var int[] */
    public array $mode;

    public int $action;

    public function __construct(int $opcode)
    {
        $this->value = str_pad((string) $opcode, 5, '0', STR_PAD_LEFT);

        $this->mode = [
            (int) $this->value[2],
            (int) $this->value[1],
            (int) $this->value[0],
        ];

        $this->action = (int) ltrim(substr($this->value, 3, 2), '0');
    }

    public function __toString()
    {
        return $this->value;
    }
}

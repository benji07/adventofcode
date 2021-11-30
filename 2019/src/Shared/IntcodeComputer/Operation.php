<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation\Add;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation\End;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation\Equals;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation\Input;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation\JumpIfFalse;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation\JumpIfTrue;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation\LessThan;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation\Multiply;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation\Output;

abstract class Operation
{
    protected IntcodeComputer $computer;

    protected Opcode $opcode;

    public function __construct(IntcodeComputer $computer, Opcode $opcode)
    {
        $this->computer = $computer;
        $this->opcode = $opcode;
    }

    public static function create(IntcodeComputer $computer): self
    {
        $opcode = new Opcode($computer->getCurrent());

        switch ($opcode->action) {
            case Opcode::ACTION_ADD:
                return new Add($computer, $opcode, $computer->getNext(), $computer->getNext(), $computer->getNext());
            case Opcode::ACTION_MULTIPLY:
                return new Multiply($computer, $opcode, $computer->getNext(), $computer->getNext(), $computer->getNext());
            case Opcode::ACTION_INPUT:
                return new Input($computer, $opcode, $computer->getNext());
            case Opcode::ACTION_OUTPUT:
                return new Output($computer, $opcode, $computer->getNext());
            case Opcode::ACTION_JUMP_TRUE:
                return new JumpIfTrue($computer, $opcode, $computer->getNext(), $computer->getNext());
            case Opcode::ACTION_JUMP_FALSE:
                return new JumpIfFalse($computer, $opcode, $computer->getNext(), $computer->getNext());
            case Opcode::ACTION_LESS_THAN:
                return new LessThan($computer, $opcode, $computer->getNext(), $computer->getNext(), $computer->getNext());
            case Opcode::ACTION_EQUALS:
                return new Equals($computer, $opcode, $computer->getNext(), $computer->getNext(), $computer->getNext());
            case Opcode::ACTION_END:
                return new End($computer, $opcode);
            default:
                throw new \InvalidArgumentException('=' . $opcode->action);
        }
    }

    abstract public function apply(string &$output): void;
}

<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Opcode;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

class JumpIfFalse extends Operation
{
    /** @var int[] */
    private array $parameters;

    public function __construct(IntcodeComputer $computer, Opcode $opcode, int ...$parameters)
    {
        parent::__construct($computer, $opcode);

        $this->parameters = $parameters;
    }

    public function apply(string &$output): void
    {
        if ($this->getParameter(0) === 0) {
            $this->computer->memoryJump($this->getParameter(1) - 1);
        }
    }

    public function getParameter(int $index): int
    {
        if ($this->opcode->mode[$index] === Opcode::MODE_POSITION) {
            return $this->computer->get($this->parameters[$index]);
        }

        return $this->parameters[$index];
    }
}

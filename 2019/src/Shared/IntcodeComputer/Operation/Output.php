<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Opcode;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

class Output extends Operation
{
    /** @var int */
    private int $parameter;

    public function __construct(IntcodeComputer $computer, Opcode $opcode, int $parameter)
    {
        parent::__construct($computer, $opcode);

        $this->parameter = $parameter;
    }

    public function apply(string &$output): void
    {
        $output .= $this->getParameter();
    }

    protected function getParameter(): int
    {
        if ($this->opcode->mode[0] === Opcode::MODE_POSITION) {
            return $this->computer->get($this->parameter);
        }

        return $this->parameter;
    }
}

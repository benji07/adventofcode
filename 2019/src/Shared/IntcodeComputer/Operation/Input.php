<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Opcode;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

class Input extends Operation
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
        $input = $this->computer->getInput();

        $this->computer->set($this->parameter, $input);
    }
}

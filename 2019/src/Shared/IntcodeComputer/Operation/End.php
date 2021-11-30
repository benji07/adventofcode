<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

use Benji07\AdventOfCode\Shared\IntcodeComputer\EndOfProgramException;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

class End extends Operation
{
    public function apply(string &$output): void
    {
        throw new EndOfProgramException((int) $output);
    }
}

<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer;

class EndOfProgramException extends \DomainException
{
    private int $output;

    public function __construct(int $output)
    {
        parent::__construct('end of program');

        $this->output = $output;
    }

    public function getOutput(): int
    {
        return $this->output;
    }
}

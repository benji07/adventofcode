<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day7;

use Benji07\AdventOfCode\Shared\IntcodeComputer;

class Amplifier
{
    private IntcodeComputer $computer;

    public function __construct(IntcodeComputer $computer)
    {
        $this->computer = $computer;
    }

    /**
     * @param int[] $input
     */
    public function run(array $input): int
    {
        $this->computer->setInput($input);

        $result = $this->computer->resolve();

        return (int) $result;
    }

    public function reset(): void
    {
        $this->computer->reset();
    }
}

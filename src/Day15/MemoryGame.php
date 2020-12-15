<?php

declare(strict_types=1);

namespace AdventOfCode\Day15;

class MemoryGame
{
    /** @var int[][] */
    private array $turns = [];

    /**
     * @param int[] $input
     */
    public function __construct(public array $input = [])
    {
    }

    public function getNumberAt(int $stopAt): int
    {
        // 0 3 6 0
        foreach ($this->input as $turn => $value) {
            $this->turns[$value] = [$turn];
        }

        $turn = \count($this->input);

        for ($current = $turn; $current <= $stopAt; ++$current) {
            $previous = end($this->input);

            if (!\in_array($previous, \array_slice($this->input, 0, -1), true)) {
                // If that was the first time the number has been spoken, the current player says 0.
                $value = 0;
            } else {
                $value = $this->turns[$previous][0] - $this->turns[$previous][1];
            }

            if (!\array_key_exists($value, $this->turns)) {
                $this->turns[$value] = [];
            }

            array_unshift($this->turns[$value], $current);
            $this->turns[$value] = \array_slice($this->turns[$value], 0, 2);
            $this->input[] = $value;
        }

        return $this->input[$stopAt - 1];
    }
}

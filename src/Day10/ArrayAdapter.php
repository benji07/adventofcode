<?php

namespace AdventOfCode\Day10;

class ArrayAdapter
{
    /** @var int[] */
    private array $adapters;

    public function __construct(string $input)
    {
        $input = array_map('intval', explode("\n", trim($input)));
        sort($input);

        $this->adapters = $input;
    }

    public function getDifferences(): int
    {
        $differences = [1 => 1, 3 => 1, 2 => 1];

        foreach ($this->adapters as $value) {
            if (in_array($value + 1, $this->adapters, true)) {
                $differences[1]++;
            } elseif (in_array($value + 2, $this->adapters, true)) {
                $differences[2]++;
            } elseif (in_array($value + 3, $this->adapters, true)) {
                $differences[3]++;
            }
        }

        return $differences[1] * $differences[2] * $differences[3];
    }
}

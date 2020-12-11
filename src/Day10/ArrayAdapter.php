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

    public function countArrangements(): int
    {
        /** @var int[] $adapters */
        $adapters = array_merge([0, (int) max($this->adapters) + 3], $this->adapters);

        $adjacencyList = [];
        foreach ($adapters as $from) {
            foreach ($adapters as $to) {
                $diff = $to - $from;
                if ($diff > 0 && $diff <= 3) {
                    $adjacencyList[$from][] = $to;
                }
            }
        }

        return $this->countPath($adjacencyList, 0);
    }

    public function countPath(array $list, int $node): int
    {
        static $cache = [];

        if (array_key_exists($node, $cache)) {
            return $cache[$node];
        }

        if (!array_key_exists($node, $list)) {
            return 1;
        }

        $cache[$node] = (int) array_sum(array_map(fn(int $child): int => $this->countPath($list, $child), $list[$node]));

        return $cache[$node];
    }
}

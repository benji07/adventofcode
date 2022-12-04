<?php

declare(strict_types=1);

namespace AOC2022\Day04;

class Part1
{
    public function __invoke(string $input): int
    {
        $pairs = explode(PHP_EOL, trim($input));

        $found = 0;

        foreach ($pairs as $pair) {
            sscanf($pair, '%d-%d,%d-%d', $firstStart, $firstEnd, $secondStart, $secondEnd);

            $a = [(int) $firstStart, (int) $firstEnd];
            $b = [(int) $secondStart, (int) $secondEnd];
            if ($this->isContains($a, $b) || $this->isContains($b, $a)) {
                ++$found;
            }
        }

        return $found;
    }

    /**
     * @param array{int, int} $a
     * @param array{int, int} $b
     */
    private function isContains(array $a, array $b): bool
    {
        return $a[0] <= $b[0] && $a[1] >= $b[1];
    }
}

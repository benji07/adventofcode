<?php

declare(strict_types=1);

namespace AOC2022\Day04;

class Part2
{
    public function __invoke(string $input): int
    {
        $pairs = explode(PHP_EOL, trim($input));

        $found = 0;

        foreach ($pairs as $pair) {
            sscanf($pair, '%d-%d,%d-%d', $firstStart, $firstEnd, $secondStart, $secondEnd);

            $a = [(int) $firstStart, (int) $firstEnd];
            $b = [(int) $secondStart, (int) $secondEnd];
            if ($this->isOverlapping($a, $b) || $this->isOverlapping($b, $a)) {
                ++$found;
            }
        }

        return $found;
    }

    /**
     * @param array{int, int} $a
     * @param array{int, int} $b
     */
    private function isOverlapping(array $a, array $b): bool
    {
        return $a[0] <= $b[1] && $a[1] >= $b[0];
    }
}

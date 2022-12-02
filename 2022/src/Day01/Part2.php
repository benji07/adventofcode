<?php

declare(strict_types=1);

namespace AOC2022\Day01;

class Part2
{
    public function __invoke(string $input): int
    {
        $elves = array_map(
            'array_sum',
            array_map(
                static fn (string $elf): array => array_map('intval', explode("\n", $elf)),
                explode("\n\n", $input))
        );

        rsort($elves);
        $top3 = \array_slice($elves, 0, 3);

        return (int) array_sum($top3);
    }
}

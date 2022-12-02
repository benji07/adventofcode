<?php

namespace AOC2022\Day01;

class Part1
{
    public function __invoke(string $input): int
    {
        return (int) max(
            array_map(
                'array_sum',
                array_map(
                    static fn (string $elf): array => array_map('intval', explode("\n", $elf)),
                    explode("\n\n", $input)
                )
            )
        );
    }
}

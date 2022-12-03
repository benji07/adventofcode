<?php

declare(strict_types=1);

namespace AOC2022\Day03;

class Part2
{
    /** @var array<string, int> */
    private array $values;

    public function __construct()
    {
        $this->values = array_merge(
            array_combine(range('a', 'z'), range(1, 26)),
            array_combine(range('A', 'Z'), range(27, 52)),
        );
    }

    public function __invoke(string $input): int
    {
        $rucksacks = explode(PHP_EOL, trim($input));

        $groups = array_chunk($rucksacks, 3);
        $score = 0;

        foreach ($groups as $elves) {
            $letter = current(array_intersect(...array_map('str_split', $elves)));

            $score += $this->getValue((string) $letter);
        }

        return $score;
    }

    private function getValue(string $letter): int
    {
        return $this->values[$letter];
    }
}

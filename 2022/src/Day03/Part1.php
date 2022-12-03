<?php

declare(strict_types=1);

namespace AOC2022\Day03;

class Part1
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

        $score = 0;

        foreach ($rucksacks as $rucksack) {
            $length = (int) (\strlen($rucksack) / 2);
            if ($length < 1) {
                throw new \Exception();
            }

            [$first, $second] = str_split($rucksack, $length);

            $letter = current(array_intersect(str_split($first), str_split($second)));

            $score += $this->getValue((string) $letter);
        }

        return $score;
    }

    private function getValue(string $letter): int
    {
        return $this->values[$letter];
    }
}

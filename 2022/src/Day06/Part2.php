<?php

declare(strict_types=1);

namespace AOC2022\Day06;

class Part2
{
    public function __invoke(string $input): int
    {
        $letters = [];
        $i = 0;
        do {
            $letter = $input[0];
            $input = substr_replace($input, '', 0, 1);

            $letters = array_values($letters);

            if (!\in_array($letter, $letters, true)) {
                $letters[] = $letter;
            } else {
                $index = array_search($letter, $letters, true);
                for ($j = 0; $j <= $index; ++$j) {
                    array_shift($letters);
                }

                $letters[] = $letter;
            }
            ++$i;
        } while (\count($letters) < 14);

        return $i;
    }
}

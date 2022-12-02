<?php

declare(strict_types=1);

namespace AOC2022\Day02;

class Part1
{
    public function __invoke(string $input): int
    {
        $rounds = explode("\n", trim($input));

        $total = 0;

        foreach ($rounds as $round) {
            [$opponent, $me] = explode(' ', $round);

            $opponent = match ($opponent) {
                'A' => Hand::Rock, 'B' => Hand::Paper, 'C' => Hand::Scissor, default => throw new \RuntimeException()
            };

            $me = match ($me) {
                'X' => Hand::Rock, 'Y' => Hand::Paper, 'Z' => Hand::Scissor, default => throw new \RuntimeException()
            };

            $score = match ($me) {
                Hand::Rock => 1,
                Hand::Paper => 2,
                Hand::Scissor => 3,
            };

            $win = $me->win($opponent);

            if ($win === true) {
                $score += 6;
            } elseif ($win === null) {
                $score += 3;
            }

            $total += $score;
        }

        return $total;
    }
}

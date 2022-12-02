<?php

declare(strict_types=1);

namespace AOC2022\Day02;

class Part2
{
    public function __invoke(string $input): int
    {
        $rounds = explode("\n", trim($input));

        $total = 0;

        foreach ($rounds as $round) {
            [$other, $me] = explode(' ', $round);

            $opponent = match ($other) {
                'A' => Hand::Rock, 'B' => Hand::Paper, 'C' => Hand::Scissor, default => throw new \RuntimeException()
            };

            $me = match ($me) {
                'X' => Result::Loose, 'Y' => Result::Draw, 'Z' => Result::Win, default => throw new \RuntimeException()
            };

            $hand = $opponent->expectedResult($me);

            $score = match ($hand) {
                Hand::Rock => 1,
                Hand::Paper => 2,
                Hand::Scissor => 3,
            };
            // on doit trouver quel main faire en fonction de ma lettre

            if ($me === Result::Win) {
                $score += 6;
            } elseif ($me === Result::Draw) {
                $score += 3;
            }

            $total += $score;
        }

        return $total;
    }
}

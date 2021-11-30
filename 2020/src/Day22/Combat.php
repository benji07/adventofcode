<?php

declare(strict_types=1);

namespace AdventOfCode\Day22;

class Combat
{
    public int $round;

    public function __construct(public array $player1, public array $player2)
    {
        $this->round = 0;
    }

    public function play(): void
    {
        while (\count($this->player1) !== 0 && \count($this->player2) !== 0) {
            ++$this->round;

            $card1 = array_shift($this->player1);
            $card2 = array_shift($this->player2);

            if ($card1 >= $card2) {
                $this->player1[] = $card1;
                $this->player1[] = $card2;
            } else {
                $this->player2[] = $card2;
                $this->player2[] = $card1;
            }
        }
    }

    public function getScore(): int
    {
        if (\count($this->player1) !== 0) {
            return $this->computeScore($this->player1);
        }

        if (\count($this->player2) !== 0) {
            return $this->computeScore($this->player2);
        }

        return 0;
    }

    public function computeScore(array $deck): int
    {
        $sortedDeck = array_values($deck);
        $multiplier = \count($sortedDeck);
        $score = 0;
        foreach ($sortedDeck as $index => $card) {
            $score += $card * ($multiplier - $index);
        }

        return $score;
    }
}

<?php

declare(strict_types=1);

namespace AdventOfCode\Day22;

class RecursiveCombat
{
    public int $round;

    /** @var int[] */
    public static $cache = [];

    public function __construct(public array $player1, public array $player2, public int $game = 1)
    {
        $this->round = 0;
    }

    public function play(): int
    {
        printf("=== Game %d === \n\n", $this->game);

        $previousRounds = [];
        while (\count($this->player1) !== 0 && \count($this->player2) !== 0) {
            ++$this->round;

            printf("\n-- Round %d (Game %d) --\n", $this->round, $this->game);
            printf("Player 1's deck: %s\n", implode(', ', $this->player1));
            printf("Player 2's deck: %s\n", implode(', ', $this->player2));

            $card1 = array_shift($this->player1);
            $card2 = array_shift($this->player2);

            printf("Player 1 plays: %d\n", $card1);
            printf("Player 2 plays: %d\n", $card2);

            $currentRound = implode('-', [$card1, $card2]);

            if (\in_array($currentRound, $previousRounds, true)) {
                printf("The winner of game %d is player 1!\n\n", $this->game);

                return 1;
            }

            $previousRounds[] = $currentRound;
            if (\count($this->player1) >= $card1 && \count($this->player2) >= $card2) {
                // If both players have at least as many cards remaining in their deck as the value of the card they just drew,
                // the winner of the round is determined by playing a new game of Recursive Combat (see below).
                $player1Deck = \array_slice(array_values($this->player1), 0, $card1);
                $player2Deck = \array_slice(array_values($this->player2), 0, $card2);
                $hash = implode('|', [implode(',', $player1Deck), implode(',', $player2Deck)]);

                printf("Playing a sub-game to determine the winner...\n\n");
                if (!\array_key_exists($hash, self::$cache)) {
                    $subGame = new RecursiveCombat(
                        $player1Deck,
                        $player2Deck,
                        $this->game + 1
                    );

                    self::$cache[$hash] = $subGame->play();
                }
                printf("...anyway, back to game %d.\n", $this->game);

                $winner = self::$cache[$hash];
            } else {
                // Otherwise, at least one player must not have enough cards left in their deck to recurse; the winner of the round is the player with the higher-value card.
                $winner = $card1 >= $card2 ? 1 : 2;
            }
            if ($winner === 1) {
                $this->player1[] = $card1;
                $this->player1[] = $card2;
            } else {
                $this->player2[] = $card2;
                $this->player2[] = $card1;
            }

            printf("Player %d wins round %d of game %d!\n", $winner, $this->round, $this->game);
        }

        $winner = \count($this->player1) !== 0 ? 1 : 2;
        printf("The winner of game %d is player %d!\n\n", $this->game, $winner);

        return $winner;
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

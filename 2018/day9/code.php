<?php

function it($m, $p)
{
    echo "\033[3", $p ? '2m✔︎' : '1m✘' . register_shutdown_function(
            function () {
                die(1);
            }
        ), " It $m\033[0m\n";
}

class Game
{
    private $currentPlayer = 1;

    private $nbPlayers;

    private $lastMarble;

    private $marbles = [0];

    private $scores = [];

    private $details = [];

    private $index = 0;

    public function __construct(int $nbPlayers, int $lastMarble)
    {
        $this->nbPlayers = $nbPlayers;
        $this->lastMarble = $lastMarble;
        $this->scores = array_fill(1, $nbPlayers, 0);
        $this->details = array_fill(1, $nbPlayers, []);
    }

    public function compute(): int
    {
        foreach (range(1, $this->lastMarble) as $marble) {
            if ($marble % 23 == 0) {
                $this->move(-7);
                $removed = $this->extract();

                $this->scores[$this->currentPlayer] += $marble + $removed;
                $this->details[$this->currentPlayer][] = ['%23' => $marble, 'removed' => $removed];

                if ($this->nbPlayers <= $this->currentPlayer) {
                    $this->currentPlayer = 1;
                } else {
                    $this->currentPlayer++;
                }

                continue;
            }

            $this->insert($marble, +2);
            if ($this->nbPlayers <= $this->currentPlayer) {
                $this->currentPlayer = 1;
            } else {
                $this->currentPlayer++;
            }
        }

        return max(...$this->scores);
    }

    private function move(int $move): void
    {
        $index = $this->index;
        $maxIndex = count($this->marbles);
        $newIndex = $index + $move;

        if ($newIndex > 0 && $newIndex <= $maxIndex) {
            $this->index = $newIndex;

            return;
        }
        if ($newIndex > $maxIndex) {
            $this->index = $newIndex - $maxIndex;
        }

        if ($newIndex < 0) {
            $this->index = $maxIndex + $newIndex;
        }
    }

    private function extract(): int
    {
        $last = false;
        if ($this->index == count($this->marbles)-1) {
            $last = true;
        }
        $value = current(array_splice($this->marbles, $this->index, 1));
        if ($last) {
            $this->index = 0;
        }
        return $value;
    }

    private function insert(int $marble, int $move): void
    {
        $this->move($move);

        array_splice($this->marbles, $this->index, 0, $marble);
    }
}

//it('9 players; last marble is worth 25 points: high score is 32', (new Game(9, 25))->compute() === 32);
//it('10 players; last marble is worth 1618 points: high score is 8317', (new Game(10, 1618))->compute() === 8317);
//it('13 players; last marble is worth 7999 points: high score is 146373', (new Game(13, 7999))->compute() === 146373);
//it('17 players; last marble is worth 114 points: high score is 2764', (new Game(17, 1104))->compute() === 2764);
//it('21 players; last marble is worth 6111 points: high score is 54718', (new Game(21, 6111))->compute() === 54718);
//it('30 players; last marble is worth 5807 points: high score is 37305', (new Game(30, 5807))->compute() === 37305);

$result = (new Game(423, 7194400))->compute();

echo $result;

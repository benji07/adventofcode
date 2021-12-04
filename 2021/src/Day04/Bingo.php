<?php

declare(strict_types=1);

namespace AOC2021\Day04;

class Bingo
{
    public function __construct(
        /** @var int[] */
        public readonly array $input,

        /** @var Board[] */
        public array $boards
    ) {
    }

    public static function createFromString(string $input): self
    {
        $data = explode("\n\n", trim($input));

        $numbersToRun = array_map('intval', explode(',', array_shift($data)));

        $boards = array_map(fn ($board) => explode("\n", $board), $data);
        array_walk($boards, function (array & $board) {
            $board = array_map(fn ($row) => preg_split('/\s+/', trim($row)), $board);
        });

        $boards = array_map(fn (array $board): Board => new Board($board), $boards);

        return new self($numbersToRun, $boards);
    }

    public function drawnNumbers(bool $wins = true): int
    {
        $boards = $this->boards;
        $drawnNumbers = [];
        foreach ($this->input as $i => $item) {
            $drawnNumbers = \array_slice($this->input, 0, $i + 1);

            foreach ($boards as $b => $board) {
                if ($board->wins($drawnNumbers)) {
                    if (!$wins && \count($boards) > 1) {
                        unset($boards[$b]);

                        continue;
                    }

                    return $board->score($drawnNumbers);
                }
            }
        }

        $lastWinningBoard = current($boards);
        \assert($lastWinningBoard instanceof Board);

        return $lastWinningBoard->score($drawnNumbers);
    }
}

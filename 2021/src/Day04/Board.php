<?php

declare(strict_types=1);

namespace AOC2021\Day04;

class Board
{
    /**
     * @param int[][] $data
     */
    public function __construct(
        /** @var int[][] */
        public readonly array $data = []
    ) {
    }

    /**
     * @param int[] $drawnNumbers
     */
    public function wins(array $drawnNumbers): bool
    {
        foreach ($this->data as $i => $row) {
            if (\count(array_diff($row, $drawnNumbers)) === 0) {
                return true;
            }

            if (\count(array_diff(array_column($this->data, $i), $drawnNumbers)) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param int[] $drawnNumbers
     */
    public function score(array $drawnNumbers): int
    {
        $notDrawnNumbers = array_diff(array_merge(...$this->data), $drawnNumbers);

        return array_sum($notDrawnNumbers) * end($drawnNumbers);
    }
}

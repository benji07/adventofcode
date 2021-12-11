<?php

declare(strict_types=1);

namespace AOC2021\Day11;

class Octopuses
{
    public function __construct(
        /** @var int[][] */
        public array $data
    ) {
    }

    /**
     * @return array<array{int, int}>
     */
    public function step(): array
    {
        array_walk_recursive($this->data, fn (& $value) => $value++);

        $flashes = [];
        do {
            $nbFlashes = \count($flashes);
            // resolve flashes
            foreach ($this->data as $y => $line) {
                foreach ($line as $x => $value) {
                    if ($value > 9 && !\in_array([$y, $x], $flashes)) {
                        $flashes[] = [$y, $x];

                        $this->increaseNeighbors($y, $x);
                    }
                }
            }
        } while (\count($flashes) != $nbFlashes);

        foreach ($flashes as [$y, $x]) {
            $this->data[$y][$x] = 0;
        }

        return $flashes;
    }

    private function increaseNeighbors(int $y, int $x): void
    {
        $this->increase($y - 1, $x - 1);
        $this->increase($y - 1, $x);
        $this->increase($y - 1, $x + 1);
        $this->increase($y, $x - 1);
        $this->increase($y, $x + 1);
        $this->increase($y + 1, $x - 1);
        $this->increase($y + 1, $x);
        $this->increase($y + 1, $x + 1);
    }

    private function increase(int $y, int $x): void
    {
        if (\array_key_exists($y, $this->data) && \array_key_exists($x, $this->data[$y])) {
            ++$this->data[$y][$x];
        }
    }
}

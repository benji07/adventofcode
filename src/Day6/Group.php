<?php

namespace AdventOfCode\Day6;

class Group
{
    /** @var string[] */
    private array $anwsers;

    public function __construct(string ...$anwsers)
    {
        $this->anwsers = $anwsers;
    }

    public function count(): int
    {
        return count(count_chars(implode('', $this->anwsers), 1));
    }

    public function countYes(): int
    {
        return count(
            array_filter(count_chars(implode('', $this->anwsers), 1), fn(int $nb) => $nb === count($this->anwsers))
        );
    }
}

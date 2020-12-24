<?php

declare(strict_types=1);

namespace AdventOfCode\Day24;

class Parser
{
    public function parse(string $input): array
    {
        if (\strlen($input) === 0) {
            return [];
        }

        if (\in_array($input[0], [Coordinate::EAST, Coordinate::WEST], true)) {
            return array_merge([$input[0]], $this->parse(substr($input, 1)));
        }

        return array_merge([substr($input, 0, 2)], $this->parse(substr($input, 2)));
    }
}

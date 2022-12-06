<?php

declare(strict_types=1);

namespace AOC2022\Day05;

class Part1
{
    public function __invoke(string $input): string
    {
        [$initialState, $instructions] = explode("\n\n", rtrim($input));

        $state = $this->parseState($initialState);

        $instructionsAsArray = explode(PHP_EOL, $instructions);

        foreach ($instructionsAsArray as $instruction) {
            sscanf($instruction, 'move %d from %d to %d', $count, $from, $to);

            for ($i = 0; $i < $count; ++$i) {
                $value = array_shift($state[$from]);
                array_unshift($state[$to], $value);
            }
        }

        return implode('', array_map(fn ($column) => $column[0], $state));
    }

    /**
     * @return array<int, string[]>
     */
    public function parseState(string $input): array
    {
        $initialState = explode("\n", $input);

        $columns = array_filter(str_split(array_pop($initialState)), static fn ($string) => $string !== ' ');

        $state = [];

        foreach ($columns as $row => $index) {
            foreach ($initialState as $boxes) {
                $state[(int) $index][] = $boxes[(int) $row] ?? null;
            }
        }

        return array_map(
            fn ($column) => array_values(array_filter($column, static fn ($item) => $item !== null && $item !== ' ')),
            $state
        );
    }
}

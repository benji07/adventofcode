<?php

namespace AdventOfCode\Day6;

class InputParser
{
    /**
     * @param string $input the input file content
     */
    public function parse(string $input): GroupCollection
    {
        $groups = explode("\n\n", trim($input));

        return new GroupCollection(
            ...array_map(
                fn(string $group) => new Group(...explode("\n", $group)),
                $groups
            )
        );
    }
}

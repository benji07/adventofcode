<?php

namespace AdventOfCode\Day20;

class Parser
{
    /**
     * @return Tile[]
     */
    public function parse(string $input): array
    {
        return array_map(static function (string $tileAsString): Tile {
            [$idPart, $imagePart] = explode("\n", $tileAsString, 2);
            [$id] = sscanf($idPart, 'Tile %d:');
            $image = array_map(fn (string $row): array => str_split($row), explode("\n", $imagePart));

            return new Tile($id, $image);
        }, explode("\n\n", $input));
    }
}

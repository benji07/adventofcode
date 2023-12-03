<?php

$input = file('input.txt');

$cubes = ['red' => 12, 'green' => 13, 'blue' => 14];
$valid = [];

$result = array_filter($input, function ($line) use ($cubes) {
    [, $game] = explode(': ', $line);

    foreach (explode('; ', $game) as $rounds) {
        foreach (explode(', ', $rounds) as $round) {
            [$nb, $color] = sscanf(trim($round), '%d %s');

            if ($cubes[$color] < $nb) {
                return false;
            }
        }
    }

    return true;
});

$valid = array_map(function($game) {
    sscanf($game, 'Game %d', $index);
    return $index;
}, $result);

echo array_sum($valid), "\n";

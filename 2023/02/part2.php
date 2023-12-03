<?php

$input = file('input.txt');

$valid = [];

$result = array_sum(array_map(static function ($line) {
    [, $game] = explode(': ', $line);

    $colors = ['red'=> 0, 'green' => 0, 'blue' => 0];

    foreach (explode('; ', $game) as $rounds) {
        foreach (explode(', ', $rounds) as $round) {
            [$nb, $color] = sscanf(trim($round), '%d %s');
            $colors[$color] = max($colors[$color], $nb);
        }
    }

    return array_product($colors);
}, $input));

echo $result, "\n";

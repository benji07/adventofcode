<?php

$input = file(__DIR__.'/input.txt');

$numbers = [];

$mapping = [
    'one' => 1,
    'two' => 2,
    'three' => 3,
    'four' => 4,
    'five' => 5,
    'six' => 6,
    'seven' => 7,
    'eight' => 8,
    'nine' => 9
];

foreach ($input as $item) {
    preg_match('/(\d|'.implode('|', array_keys($mapping)).')/', $item, $first);
    preg_match('/.*(\d|'.implode('|', array_keys($mapping)).')/', $item, $last);

    $first = $first[1];
    $first = $mapping[$first] ?? $first;
    $last = $last[1] ?? $first;
    $last = $mapping[$last] ?? $last;

    echo trim($item),' -> ', $first, $last, "\n";

    $numbers[] = (int) ($first.$last);
}

echo array_sum($numbers)."\n";

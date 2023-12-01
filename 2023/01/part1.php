<?php

$input = file(__DIR__.'/input.txt');

$numbers = [];

foreach ($input as $item) {
    preg_match_all('/\d/', $item, $values);


    $numbers[] = (int) (reset($values[0]).end($values[0]));
}

echo array_sum($numbers)."\n";

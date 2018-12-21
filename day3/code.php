<?php

$lines = file('input.txt');

$boards = [];

// $lines = [
// '#1 @ 1,3: 4x4',
// '#2 @ 3,1: 4x4',
// '#3 @ 5,5: 2x2',
// ];

$ids = [];

foreach ($lines as $line) {
    list($id, $left, $top, $width, $height)  = sscanf($line, '#%d @ %d,%d: %dx%d');

    $right = $left + $width;
    $bottom = $top + $height;
$ids[$id] = $id;
    for ($i = $left; $i < $right; $i++) {
        for ($j = $top; $j < $bottom; $j++) {
            if (!array_key_exists($i, $boards)) {
                $boards[$i] = [];
            }

            if (!array_key_exists($j, $boards[$i])) {
                $boards[$i][$j] = [];
            }

            $boards[$i][$j][] = $id;
        }
    }
}


$overlapIds = [];
$found = 0;
foreach ($boards as $line) {
    foreach ($line as $row) {
        if (count($row) > 1) {
            $found++;
            if (count($row) > 1) {
                foreach ($row as $i) {
                    unset($ids[$i]);
                }
            }
        }
    }
}

var_dump(['id' => $ids, 'found' => $found]);

<?php

$lines = file('sample.txt');

$coordinates = [];

foreach ($lines as $line) {
    list($x, $y) = sscanf($line, '%d, %d');
    $coordinates[] = new Point($x, $y);
}


var_dump($coordinates, chr(65));

$board = [];
foreach ($coordinates as $i => $coordinate) {
    foreach (range(0, $coordinate->y) as $y) {
        foreach (range(0, $coordinate->x+1) as $x) {
            if (!array_key_exists($y, $board)) {
                $board[$y] = [];
            }

            if (!array_key_exists($x, $board[$y])) {
                $board[$y][$x] = '.';
            }
        }

    }
    $board[$coordinate->y][$coordinate->x] = chr(65 + $i);
}

foreach ($coordinates as $i => $a) {
    foreach ($coordinates as $j => $b) {
        echo chr(65+$i) . '->' . chr(65+$j) . ': ', distance($a, $b)."\n";
    }
}

foreach ($board as $rows) {
    echo implode('', $rows)."\n";
}

function distance(Point $a, Point $b)
{
    return abs($a->x - $b->x) + abs($a->y - $b->y);
}

final class Point
{
    /** @var int */
    public $x;

    /** @var int */
    public $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}

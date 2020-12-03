<?php

namespace AdventOfCode\Day3;

class Map
{
    /**
     * @param string[] $data
     */
    public function __construct(
        private array $data
    ) {}

    public function countTrees(Slope $slope): int
    {
        $trees = 0;

        $point = new Point(0, 0);

        while (!$this->bottomReached($point)){
            $point = $slope->move($point);

            if ($this->isTree($point)) {
                $trees++;
            }
        }

        return $trees;
    }

    public function bottomReached(Point $point): bool
    {
        return $point->y + 1 === count($this->data);
    }

    public function isTree(Point $point): bool
    {
        $row = $this->data[$point->y];

        $row = str_repeat($row, (int) ceil($point->x / strlen($row)) + 1);

        return $row[$point->x] === '#';
    }
}

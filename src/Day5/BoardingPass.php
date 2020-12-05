<?php

namespace AdventOfCode\Day5;

class BoardingPass
{
    public int $row;
    public int $column;
    public int $seatID;

    public function __construct(string $seatCode)
    {
        $rowCode = substr($seatCode, 0, 7);
        $this->row = (int) bindec(str_replace(['B', 'F'], [1, 0], $rowCode));
        $this->column = (int) bindec(str_replace(['L', 'R'], [0, 1], substr($seatCode, -3)));

        $this->seatID = $this->row * 8 + $this->column;
    }
}

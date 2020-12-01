<?php

namespace AdventOfCode\Day1;

class ExpenseReport
{
    /** @var int[] */
    private array $data;

    /**
     * @param int[] $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getAnswer1(): int
    {
        foreach ($this->data as $i => $firstValue) {
            foreach ($this->data as $j => $secondValue) {
                if ($firstValue + $secondValue === 2020) {
                    return $firstValue * $secondValue;
                }
            }
        }
    }

    public function getAnswer2(): int
    {
        foreach ($this->data as $i => $firstValue) {
            foreach ($this->data as $j => $secondValue) {
                foreach ($this->data as $k => $thirdValue) {
                    if ($firstValue + $secondValue + $thirdValue === 2020) {
                        return $firstValue * $secondValue * $thirdValue;
                    }
                }
            }
        }
    }
}

<?php

namespace AdventOfCode\Tests\Day1;

use AdventOfCode\Day1\ExpenseReport;
use PHPUnit\Framework\TestCase;

class ExpenseReportTest extends TestCase
{
    /**
     * @dataProvider provideGetAnswer1
     */
    public function testGetAnswer1(array $input, int $expectedResult): void
    {
        $expenseReport = new ExpenseReport($input);

        self::assertEquals($expectedResult, $expenseReport->getAnswer1());
    }

    public function provideGetAnswer1(): iterable
    {
        yield 'sample 1' => [
            [1721, 979, 366, 299, 675, 1456],
            514_579
        ];

        $data = explode("\n", file_get_contents(__DIR__.'/input1.csv'));
        $data = array_map('intval', $data);

        yield 'part 1' => [$data, 980_499];
    }

    /**
     * @dataProvider provideGetAnswer2
     */
    public function testGetAnswer2(array $input, int $expectedResult): void
    {
        $expenseReport = new ExpenseReport($input);

        self::assertEquals($expectedResult, $expenseReport->getAnswer2());
    }

    public function provideGetAnswer2(): iterable
    {
        yield 'sample 2' => [
            [1721, 979, 366, 299, 675, 1456],
            241_861_950
        ];

        $data = explode("\n", trim(file_get_contents(__DIR__.'/input1.csv')));
        $data = array_map('intval', $data);

        yield 'part 2' => [$data, 200_637_446];
    }
}

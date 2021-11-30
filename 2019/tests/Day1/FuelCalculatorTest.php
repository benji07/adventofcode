<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day1;

use Benji07\AdventOfCode\Day1\FuelCalculator;
use PHPUnit\Framework\TestCase;

class FuelCalculatorTest extends TestCase
{
    /**
     * @dataProvider provideCompute
     */
    public function testCompute(int $mass, int $expectedFuel): void
    {
        $calculator = new FuelCalculator();

        $this->assertEquals($expectedFuel, $calculator->compute($mass));
    }

    public function provideCompute(): iterable
    {
        yield [12, 2];
        yield [14, 2];
        yield [1969, 654];
        yield [100756, 33583];
    }
}

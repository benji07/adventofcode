<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day1;

use Benji07\AdventOfCode\Day1\FuelCalculator;
use Benji07\AdventOfCode\Day1\FuelCalculatorV2;
use Benji07\AdventOfCode\Day1\Runner;
use PHPUnit\Framework\TestCase;

class RunnerTest extends TestCase
{
    /**
     * @dataProvider provideTestRun
     */
    public function testRun(string $file, FuelCalculator $fuelCalculator, int $expectedFuel): void
    {
        $data = file($file);

        if ($data === false) {
            $this->fail('Invalid file');

            return;
        }

        $masses = array_map(function (string $mass) { return (int) $mass; }, $data);

        $fuel = (new Runner($fuelCalculator))->run($masses);

        $this->assertEquals($expectedFuel, $fuel);
    }

    public function provideTestRun()
    {
        yield [__DIR__ . '/data/sample.txt', new FuelCalculator(), 106_795];
        yield [__DIR__ . '/data/input.txt', new FuelCalculator(), 3_412_531];
        yield [__DIR__ . '/data/sample.txt', new FuelCalculatorV2(), 160_108];
        yield [__DIR__ . '/data/input.txt', new FuelCalculatorV2(), 5_115_927];
    }
}

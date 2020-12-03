<?php

namespace AdventOfCode\Tests\Day2;

use AdventOfCode\Day2\RuleFactoryInterface;
use AdventOfCode\Day2\RuleV1Factory;
use AdventOfCode\Day2\RuleV2Factory;
use AdventOfCode\Day2\ValidPasswordCounter;
use PHPUnit\Framework\TestCase;

class ValidPasswordCounterTest extends TestCase
{
    /**
     * @dataProvider provideTestCount
     */
    public function testCount(array $input, RuleFactoryInterface $ruleFactory, int $expectedCount) : void
    {
        $counter = new ValidPasswordCounter($ruleFactory);

        self::assertEquals($expectedCount, $counter->count($input));
    }

    public function provideTestCount(): iterable
    {
        yield [
            [
                '1-3 a: abcde',
                '1-3 b: cdefg',
                '2-9 c: ccccccccc',
            ],
            new RuleV1Factory(),
            2,
        ];

        $data = explode("\n", trim(file_get_contents(__DIR__.'/input.txt')));

        yield [$data, new RuleV1Factory(), 524];

        yield [$data, new RuleV2Factory(), 485];
    }
}

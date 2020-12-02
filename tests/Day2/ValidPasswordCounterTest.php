<?php

namespace AdventOfCode\Tests\Day2;

use AdventOfCode\Day2\Rule;
use AdventOfCode\Day2\RuleV2;
use AdventOfCode\Day2\ValidPasswordCounter;
use PHPUnit\Framework\TestCase;

class ValidPasswordCounterTest extends TestCase
{
    /**
     * @dataProvider provideTestCount
     */
    public function testCount(array $input, callable $ruleFactory, int $expectedCount) : void
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
            fn(int $min, int $max, string $letter) => new Rule($min, $max, $letter),
            2,
        ];

        $data = explode("\n", trim(file_get_contents(__DIR__.'/input.txt')));

        yield [$data, fn(int $min, int $max, string $letter) => new Rule($min, $max, $letter), 524];

        yield [$data, fn(int $min, int $max, string $letter) => new RuleV2($min, $max, $letter), 485];
    }
}

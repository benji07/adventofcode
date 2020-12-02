<?php

namespace AdventOfCode\Tests\Day2;

use AdventOfCode\Day2\RuleV2;
use PHPUnit\Framework\TestCase;

class RuleV2Test extends TestCase
{
    /**
     * @dataProvider provideTestIsValid
     */
    public function testIsValid(int $min, int $max, string $letter, string $password, bool $expectedResult): void
    {
        $rule = new RuleV2($min, $max, $letter);

        self::assertEquals($expectedResult, $rule->isValid($password));
    }

    public function provideTestIsValid(): iterable
    {
        yield [1, 3, 'a', 'abcde', true];
        yield [1, 3, 'b', 'cdefg', false];
        yield [2, 9, 'c', 'ccccccccc', false];
    }
}

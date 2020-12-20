<?php

namespace AdventOfCode\Tests\Day19;

use AdventOfCode\Day19\RuleCollection;
use PHPUnit\Framework\TestCase;

class RuleCollectionTest extends TestCase
{
    /**
     * @dataProvider provideTestSample1
     */
    public function testSample1(array $input, string $string, bool $expectedResult): void
    {
        $collection = new RuleCollection($input);

        self::assertEquals($expectedResult, $collection->validate($string));
    }

    public function provideTestSample1(): iterable
    {
        $rules = [
            '0: 1 2',
            '1: "a"',
            '2: 1 3 | 3 1',
            '3: "b"',
        ];

        yield [$rules, 'aab', true];
        yield [$rules, 'aba', true];
        yield [$rules, 'aaa', false];
        yield [$rules, 'bba', false];

        $rules = [
            '0: 4 1 5',
            '1: 2 3 | 3 2',
            '2: 4 4 | 5 5',
            '3: 4 5 | 5 4',
            '4: "a"',
            '5: "b"',
        ];

        yield [$rules, 'ababbb', true];
        yield [$rules, 'abbbab', true];
        yield [$rules, 'bababa', false];
        yield [$rules, 'aaabbb', false];
        yield [$rules, 'aaaabbb', false];
    }

    public function testSample(): void
    {
        [$rules, $tests] = explode("\n\n", file_get_contents(__DIR__.'/sample.txt'));
        $rules = new RuleCollection(explode("\n", trim($rules)));

        self::assertEquals(2, $rules->countMatches(explode("\n", trim($tests))));
    }

    public function testPart1(): void
    {
        [$rules, $tests] = explode("\n\n", file_get_contents(__DIR__.'/input.txt'));
        $rules = new RuleCollection(explode("\n", trim($rules)));

        self::assertEquals(165, $rules->countMatches(explode("\n", trim($tests))));
    }

    public function testSample2(): void
    {
        [$rules, $tests] = explode("\n\n", file_get_contents(__DIR__.'/sample2.txt'));
        $tests = explode("\n", trim($tests));

        $rules = new RuleCollection(explode("\n", trim($rules)));

        self::assertEquals(3, $rules->countMatches($tests));

        $rules->set(8, '42 | 42 8');
        $rules->set(11, '42 31 | 42 11 31');

        self::assertEquals(12, $rules->countMatches($tests));
    }

    public function testPart2(): void
    {
        [$rules, $tests] = explode("\n\n", file_get_contents(__DIR__.'/input.txt'));
        $rules = new RuleCollection(explode("\n", trim($rules)));
ini_set('pcre.jit', 0);
        $rules->set(8, '42 | 42 8');
        $rules->set(11, '42 31 | 42 11 31');

        self::assertEquals(165, $rules->countMatches(explode("\n", trim($tests))));
    }
}

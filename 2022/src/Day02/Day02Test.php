<?php

declare(strict_types=1);

namespace AOC2022\Day02;

class Day02Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provideTestWin
     */
    public function testWin(Hand $me, Hand $opponent, ?bool $expectedResult): void
    {
        self::assertEquals($expectedResult, $me->win($opponent));
    }

    /**
     * @return iterable<array{Hand, Hand, ?bool}>
     */
    public function provideTestWin(): iterable
    {
        yield 'Rock win against scissor' => [Hand::Rock, Hand::Scissor, true];
        yield 'Rock loose against paper' => [Hand::Rock, Hand::Paper, false];
        yield 'Paper win against rock' => [Hand::Paper, Hand::Rock, true];
        yield 'Paper loose against scissor' => [Hand::Paper, Hand::Scissor, false];
        yield 'Scissor win against paper' => [Hand::Scissor, Hand::Paper, true];
        yield 'Scissor loose against rock' => [Hand::Scissor, Hand::Rock, false];
        yield 'Scissor tie' => [Hand::Scissor, Hand::Scissor, null];
        yield 'Rock tie' => [Hand::Rock, Hand::Rock, null];
        yield 'Paper tie' => [Hand::Paper, Hand::Paper, null];
    }

    /**
     * @dataProvider provideTestPart1
     */
    public function testPart1(string $input, int $expectedResult): void
    {
        $runner = new Part1();

        $result = $runner($input);

        self::assertEquals($expectedResult, $result);
    }

    /**
     * @return iterable<array{string, int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [(string) file_get_contents(__DIR__ . '/sample.txt'), 15];
        yield 'input' => [(string) file_get_contents(__DIR__ . '/input.txt'), 12_586];
    }

    /**
     * @dataProvider provideTestPart2
     */
    public function testPart2(string $input, int $expectedResult): void
    {
        $runner = new Part2();

        $result = $runner($input);

        self::assertEquals($expectedResult, $result);
    }

    /**
     * @return iterable<array{string, int}>
     */
    public function provideTestPart2(): iterable
    {
        yield 'sample' => [(string) file_get_contents(__DIR__ . '/sample.txt'), 12];
        yield 'input' => [(string) file_get_contents(__DIR__ . '/input.txt'), 13_193];
    }
}

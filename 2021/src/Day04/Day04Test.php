<?php

declare(strict_types=1);

namespace AOC2021\Day04;

use PHPUnit\Framework\TestCase;

class Day04Test extends TestCase
{
    /**
     * @dataProvider provideTestPart1
     */
    public function testPart1(Bingo $input, int $expectedResult): void
    {
        $result = $input->drawnNumbers(true);

        self::assertEquals($expectedResult, $result);
    }

    /**
     * @return iterable<array{Bingo, int}>
     */
    public function provideTestPart1(): iterable
    {
        yield 'sample' => [$this->getSampleInput(), 4512];
        yield 'input' => [$this->getInput(), 33_348];
    }

    /**
     * @dataProvider provideTestPart2
     */
    public function testPart2(Bingo $input, int $expectedResult): void
    {
        $result = $input->drawnNumbers(false);

        self::assertEquals($expectedResult, $result);
    }

    /**
     * @return iterable<array{Bingo, int}>
     */
    public function provideTestPart2(): iterable
    {
        yield [$this->getSampleInput(), 1924];
        yield [$this->getInput(), 8_112];
    }

    private function getSampleInput(): Bingo
    {
        return Bingo::createFromString((string) file_get_contents(__DIR__ . '/sample.txt'));
    }

    protected function getInput(): Bingo
    {
        return Bingo::createFromString((string) file_get_contents(__DIR__ . '/input.txt'));
    }
}

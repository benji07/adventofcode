<?php

namespace AdventOfCode\Tests\Day9;

use AdventOfCode\Day9\XmasCipher;
use PHPUnit\Framework\TestCase;

class XmasCipherTest extends TestCase
{

    /**
     * @dataProvider provideTestIsValid
     */
    public function testIsValid(array $preamble, int $value, bool $expectedResult): void
    {
        $finder = new XmasCipher();

        self::assertEquals($expectedResult, $finder->isValid($preamble, $value));
    }

    public function provideTestIsValid(): iterable
    {
        $preamble = range(1, 25);

        yield [
            $preamble,
            26,
            true,
        ];

        yield [
            $preamble,
            49,
            true,
        ];

        yield [
            $preamble,
            100,
            false,
        ];

        yield [
            $preamble,
            50,
            false,
        ];
    }

    public function testSample1(): void
    {
        $input = <<<INPUT
35
20
15
25
47
40
62
55
65
95
102
117
150
182
127
219
299
277
309
576
INPUT;

        $finder = new XmasCipher();
        $data = $this->cleanInput($input);

        self::assertEquals(127, $finder->getInvalid(5, $data));

    }

    public function testPart1(): void
    {
        $finder = new XmasCipher();

        $data = $this->cleanInput(file_get_contents(__DIR__ . '/input.txt'));

        self::assertEquals(36_845_998, $finder->getInvalid(25, $data));
    }

    public function testSample2(): void
    {
        $input = <<<INPUT
35
20
15
25
47
40
62
55
65
95
102
117
150
182
127
219
299
277
309
576
INPUT;
        $finder = new XmasCipher();

        $data = $this->cleanInput($input);
        self::assertEquals(62, $finder->findEncryptionWeekness($data, $finder->getInvalid(5, $data)));
    }

    public function testPart2(): void
    {
        $finder = new XmasCipher();

        $data = $this->cleanInput(file_get_contents(__DIR__ . '/input.txt'));

        $invalid = $invalid = $finder->getInvalid(25, $data);

        self::assertEquals(4_830_226, $finder->findEncryptionWeekness($data, $invalid));
    }

    private function cleanInput(string $input): array
    {
        return array_map('intval', explode("\n", trim($input)));
    }
}

<?php

namespace AdventOfCode\Tests\Day4;

use AdventOfCode\Day4\Field;
use AdventOfCode\Day4\FieldFactory;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
    /**
     * @dataProvider provideTestIsValid
     */
    public function testIsValid(string $type, string $value, bool $expectedResult)
    {
        $field = (new FieldFactory())->create($type, $value);

        self::assertEquals($expectedResult, $field->isValid());
    }

    public function provideTestIsValid(): iterable
    {
        yield ['byr', '2002', true];
        yield ['byr', '2003', false];
        yield ['hgt', '60in', true];
        yield ['hgt', '190cm', true];
        yield ['hgt', '190in', false];
        yield ['hgt', '190', false];
        yield ['hcl', '#123abc', true];
        yield ['hcl', '#123abz', false];
        yield ['hcl', '123abc', false];
        yield ['ecl', 'brn', true];
        yield ['ecl', 'wat', false];
        yield ['pid', '000000001', true];
        yield ['pid', '0123456789', false];
    }
}

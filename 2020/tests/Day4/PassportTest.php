<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day4;

use AdventOfCode\Day4\PassportParser;
use PHPUnit\Framework\TestCase;

class PassportTest extends TestCase
{
    /**
     * @dataProvider provideTestIsValid
     */
    public function testIsValid(string $passportData, bool $expectedResult): void
    {
        $passport = (new PassportParser())->parse($passportData);

        self::assertEquals($expectedResult, $passport->isValid());
    }

    public function provideTestIsValid(): iterable
    {
        yield [
            'ecl:gry pid:860033327 eyr:2020 hcl:#fffffd
byr:1937 iyr:2017 cid:147 hgt:183cm',
            true,
        ];

        yield [
            'iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884
hcl:#cfa07d byr:1929',
            false,
        ];

        yield [
            'hcl:#ae17e1 iyr:2013
eyr:2024
ecl:brn pid:760753108 byr:1931
hgt:179cm',
            true,
        ];

        yield [
            'hcl:#cfa07d eyr:2025 pid:166559648
iyr:2011 ecl:brn hgt:59in',
            false,
        ];
    }
}

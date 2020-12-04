<?php

namespace AdventOfCode\Tests\Day4;

use AdventOfCode\Day4\Field;
use AdventOfCode\Day4\Passport;
use AdventOfCode\Day4\PassportParser;
use PHPUnit\Framework\TestCase;

class PassportParserTest extends TestCase
{
    /**
     * @dataProvider provideTestParse
     */
    public function testParse(string $data, Passport $expectedResult)
    {
        $parser = new PassportParser();
        $passport = $parser->parse($data);

        self::assertEquals($expectedResult, $passport);
    }

    public function provideTestParse(): iterable
    {
        yield [
            "ecl:gry pid:860033327 eyr:2020 hcl:#fffffd\nbyr:1937 iyr:2017 cid:147 hgt:183cm",
            new Passport(
                new Field('ecl', 'gry'),
                new Field('pid', '860033327'),
                new Field('eyr', '2020'),
                new Field('hcl', '#fffffd'),
                new Field('byr', '1937'),
                new Field('iyr', '2017'),
                new Field('cid', '147'),
                new Field('hgt', '183cm'),
            )
        ];

        yield [
            "hcl:#ae17e1 iyr:2013
eyr:2024
ecl:brn pid:760753108 byr:1931
hgt:179cm",
            new Passport(
                new Field('hcl', '#ae17e1'),
                new Field('iyr', '2013'),
                new Field('eyr', '2024'),
                new Field('ecl', 'brn'),
                new Field('pid', '760753108'),
                new Field('byr', '1931'),
                new Field('hgt', '179cm'),
            )
        ];
    }
}

<?php

namespace AdventOfCode\Tests\Day4;

use AdventOfCode\Day4\FieldFactory;
use AdventOfCode\Day4\Passport;
use AdventOfCode\Day4\PassportCollectionParser;
use AdventOfCode\Day4\PassportParser;
use AdventOfCode\Day4\SmartPassportParser;
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    public function testSample(): void
    {
        $input = file_get_contents(__DIR__.'/sample.txt');

        $passports = (new PassportCollectionParser(new PassportParser()))->parse($input);

        $validPassport = array_filter($passports, fn (Passport $passport): bool => $passport->isValid());

        self::assertCount(2, $validPassport);
    }

    public function testPart1(): void
    {
        $input = file_get_contents(__DIR__.'/input.txt');

        $passports = (new PassportCollectionParser(new PassportParser()))->parse($input);

        $validPassport = array_filter($passports, fn (Passport $passport): bool => $passport->isValid());

        self::assertCount(264, $validPassport);
    }

    public function testSample2Valid(): void
    {
        $input = file_get_contents(__DIR__.'/sample2-valid.txt');

        $passports = (new PassportCollectionParser(new SmartPassportParser(new FieldFactory())))->parse($input);

        $validPassport = array_filter($passports, fn (Passport $passport): bool => $passport->isValid());

        self::assertCount(4, $validPassport);
    }

    public function testSample2Invalid(): void
    {
        $input = file_get_contents(__DIR__.'/sample2-invalid.txt');

        $passports = (new PassportCollectionParser(new SmartPassportParser(new FieldFactory())))->parse($input);

        $validPassport = array_filter($passports, fn (Passport $passport): bool => $passport->isValid());

        self::assertCount(0, $validPassport);
    }

    public function testPart2(): void
    {
        $input = file_get_contents(__DIR__.'/input.txt');

        $passports = (new PassportCollectionParser(new SmartPassportParser(new FieldFactory())))->parse($input);

        $validPassport = array_filter($passports, fn (Passport $passport): bool => $passport->isValid());

        self::assertCount(224, $validPassport);
    }
}

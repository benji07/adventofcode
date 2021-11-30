<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day4;

use Benji07\AdventOfCode\Day4\PasswordFinder;
use PHPUnit\Framework\TestCase;

class PasswordFinderTest extends TestCase
{
    /**
     * @dataProvider provideTestAssertTwoAdjacentDigits
     */
    public function testAssertTwoAdjacentDigits(int $number, bool $expectedResult): void
    {
        $passwordFinder = new PasswordFinder();

        $this->assertEquals($expectedResult, $passwordFinder->assertTwoAdjacentDigits($number));
    }

    public function provideTestAssertTwoAdjacentDigits(): \Generator
    {
        yield [1234, false];
        yield [11234, true];
        yield [12234, true];
        yield [12334, true];
        yield [12344, true];
        yield [12324, false];
    }

    /**
     * @dataProvider provideTestAssertDigitsNeverDecrease
     */
    public function testAssertDigitsNeverDecrease(int $number, bool $expectedResult)
    {
        $passwordFinder = new PasswordFinder();

        $this->assertEquals($expectedResult, $passwordFinder->assertDigitsNeverDecrease($number));
    }

    public function provideTestAssertDigitsNeverDecrease(): \Generator
    {
        yield [111111, true];
        yield [223450, false];
        yield [123789, true];
    }

    public function testCountPart1()
    {
        $passwordFinder = new PasswordFinder();

        $this->assertEquals(1079, $passwordFinder->count(245318, 765747));
    }

    /**
     * @dataProvider provideTestAssertNoLargerAdjacentDigits
     */
    public function testAssertNoLargerAdjacentDigits(int $number, bool $expectedResult): void
    {
        $passwordFinder = new PasswordFinder();

        $this->assertEquals($expectedResult, $passwordFinder->assertNoLargerAdjacentDigits($number));
    }

    public function provideTestAssertNoLargerAdjacentDigits(): \Generator
    {
        yield [112233, true];
        yield [123444, false];
        yield [111122, true];
    }

    public function testCountPart2()
    {
        $passwordFinder = new PasswordFinder();

        $this->assertEquals(699, $passwordFinder->countPart2(245318, 765747));
    }
}

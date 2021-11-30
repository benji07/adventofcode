<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day4;

class PasswordFinder
{
    public function count(int $min, int $max): int
    {
        $possiblePassword = [];
        foreach (range($min, $max) as $number) {
            if (!$this->assertTwoAdjacentDigits($number)) {
                continue;
            }

            if (!$this->assertDigitsNeverDecrease($number)) {
                continue;
            }

            $possiblePassword[] = $number;
        }

        return count($possiblePassword);
    }

    public function countPart2(int $min, int $max): int
    {
        $possiblePassword = [];
        foreach (range($min, $max) as $number) {
            if (!$this->assertTwoAdjacentDigits($number)) {
                continue;
            }

            if (!$this->assertDigitsNeverDecrease($number)) {
                continue;
            }

            if (!$this->assertNoLargerAdjacentDigits($number)) {
                continue;
            }

            $possiblePassword[] = $number;
        }

        return count($possiblePassword);
    }

    public function assertTwoAdjacentDigits(int $number): bool
    {
        $digits = str_split((string) $number);

        $compareDigit = $digits[0];
        $nbDigits = count($digits);
        for ($i = 1; $i < $nbDigits; ++$i) {
            if ($compareDigit == $digits[$i]) {
                return true;
            }

            $compareDigit = $digits[$i];
        }

        return false;
    }

    public function assertDigitsNeverDecrease(int $number): bool
    {
        $digits = str_split((string) $number);

        $compareDigit = $digits[0];
        $nbDigits = count($digits);
        for ($i = 1; $i < $nbDigits; ++$i) {
            if ($compareDigit > $digits[$i]) {
                return false;
            }

            $compareDigit = $digits[$i];
        }

        return true;
    }

    public function assertNoLargerAdjacentDigits(int $number): bool
    {
        $digits = str_split((string) $number);

        $compareDigit = $digits[0];
        $nbDigits = count($digits);

        $index = 0;
        $groupedDigits = [
            $digits[0],
        ];

        for ($i = 1; $i < $nbDigits; ++$i) {
            if ($compareDigit == $digits[$i]) {
                $groupedDigits[$index] .= $digits[$i];
            } else {
                ++$index;
                $groupedDigits[$index] = $digits[$i];
            }

            $compareDigit = $digits[$i];
        }

        $atLeastOneWithTwoDigits = false;
        foreach ($groupedDigits as $groupedDigit) {
            if (strlen($groupedDigit) === 2) {
                $atLeastOneWithTwoDigits = true;
            }
        }

        return $atLeastOneWithTwoDigits;
    }
}

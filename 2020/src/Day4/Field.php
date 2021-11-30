<?php

declare(strict_types=1);

namespace AdventOfCode\Day4;

class Field
{
    public const BIRTH_YEAR = 'byr';
    public const ISSUE_YEAR = 'iyr';
    public const EXPIRATION_YEAR = 'eyr';
    public const HEIGHT = 'hgt';
    public const HAIR_COLOR = 'hcl';
    public const EYE_COLOR = 'ecl';
    public const PASSPORT_ID = 'pid';
    public const COUNTRY_ID = 'cid';

    public function __construct(
        public string $type,
        public string $value
    ) {
    }

    public static function getTypes(): array
    {
        return [
            self::BIRTH_YEAR,
            self::ISSUE_YEAR,
            self::EXPIRATION_YEAR,
            self::HEIGHT,
            self::HAIR_COLOR,
            self::EYE_COLOR,
            self::PASSPORT_ID,
            self::COUNTRY_ID,
        ];
    }

    public function isValid(): bool
    {
        return true;
    }
}

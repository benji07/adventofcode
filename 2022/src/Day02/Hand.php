<?php

declare(strict_types=1);

namespace AOC2022\Day02;

enum Hand
{
    case Rock;
    case Paper;
    case Scissor;

    public function win(Hand $opponent): ?bool
    {
        if ($opponent === $this) {
            return null;
        }

        if ($this === self::Rock && $opponent === self::Scissor) {
            return true;
        }

        if ($this === self::Paper && $opponent === self::Scissor) {
            return false;
        }

        if ($this === self::Scissor && $opponent === self::Rock) {
            return false;
        }

        if ($this === self::Paper && $opponent === self::Rock) {
            return true;
        }

        if ($this === self::Rock && $opponent === self::Paper) {
            return false;
        }

        if ($this === self::Scissor && $opponent === self::Paper) {
            return true;
        }

        return null;
    }

    public function expectedResult(Result $result): Hand
    {
        return match ($result) {
            Result::Draw => $this,
            Result::Win => match ($this) {
                self::Rock => self::Paper,
                self::Scissor => self::Rock,
                self::Paper => self::Scissor,
            },
            Result::Loose => match ($this) {
                self::Rock => self::Scissor,
                self::Scissor => self::Paper,
                self::Paper => self::Rock,
            },
        };
    }
}

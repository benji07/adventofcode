<?php

declare(strict_types=1);

namespace AdventOfCode\Day4\Field;

use AdventOfCode\Day4\Field;

class ByrField extends Field
{
    public function isValid(): bool
    {
        if (0 === preg_match('/^\d{4}$/', $this->value)) {
            return false;
        }

        $year = (int) $this->value;

        return $year >= 1920 && $year <= 2002;
    }
}

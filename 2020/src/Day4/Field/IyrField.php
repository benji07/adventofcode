<?php

declare(strict_types=1);

namespace AdventOfCode\Day4\Field;

use AdventOfCode\Day4\Field;

class IyrField extends Field
{
    public function isValid(): bool
    {
        if (0 === preg_match('/^\d{4}$/', $this->value)) {
            return false;
        }

        $year = (int) $this->value;

        return $year >= 2010 && $year <= 2020;
    }
}

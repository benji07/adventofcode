<?php

namespace AdventOfCode\Day4\Field;

use AdventOfCode\Day4\Field;

class EyrField extends Field
{
    public function isValid(): bool
    {
        if (0 === preg_match('/^\d{4}$/', $this->value)) {
            return false;
        }

        $year = (int) $this->value;

        return $year >= 2020 && $year <= 2030;
    }
}

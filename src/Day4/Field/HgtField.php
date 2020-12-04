<?php

namespace AdventOfCode\Day4\Field;

use AdventOfCode\Day4\Field;

class HgtField extends Field
{
    public function isValid(): bool
    {
        if (str_ends_with($this->value, 'cm')) {
            $value = (int) substr($this->value, 0, -2);

            return $value >= 150 && $value <= 193;
        }

        if (str_ends_with($this->value, 'in')) {
            $value = (int) substr($this->value, 0, -2);

            return $value >= 59 && $value <= 76;
        }

        return false;
    }
}

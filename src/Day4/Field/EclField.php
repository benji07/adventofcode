<?php

namespace AdventOfCode\Day4\Field;

use AdventOfCode\Day4\Field;

class EclField extends Field
{
    public function isValid(): bool
    {
        return in_array($this->value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'], true);
    }
}

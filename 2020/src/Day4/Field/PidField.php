<?php

declare(strict_types=1);

namespace AdventOfCode\Day4\Field;

use AdventOfCode\Day4\Field;

class PidField extends Field
{
    public function isValid(): bool
    {
        return 1 === preg_match('/^\d{9}$/', $this->value);
    }
}

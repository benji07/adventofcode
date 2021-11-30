<?php

declare(strict_types=1);

namespace AdventOfCode\Day4\Field;

use AdventOfCode\Day4\Field;

class HclField extends Field
{
    public function isValid(): bool
    {
        return 1 === preg_match('/^#[0-9a-f]{6}$/', $this->value);
    }
}

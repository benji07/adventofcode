<?php

namespace AdventOfCode\Day4;

use AdventOfCode\Day4\Field\ByrField;
use AdventOfCode\Day4\Field\EclField;
use AdventOfCode\Day4\Field\EyrField;
use AdventOfCode\Day4\Field\HclField;
use AdventOfCode\Day4\Field\HgtField;
use AdventOfCode\Day4\Field\IyrField;
use AdventOfCode\Day4\Field\PidField;

class FieldFactory
{
    public function create(string $type, string $value): Field
    {
        return match ($type) {
            Field::BIRTH_YEAR => new ByrField($type, $value),
            Field::ISSUE_YEAR => new IyrField($type, $value),
            Field::EXPIRATION_YEAR => new EyrField($type, $value),
            Field::HEIGHT => new HgtField($type, $value),
            Field::HAIR_COLOR => new HclField($type, $value),
            Field::EYE_COLOR => new EclField($type, $value),
            Field::PASSPORT_ID => new PidField($type, $value),
            default => new Field($type, $value)
        };
    }
}

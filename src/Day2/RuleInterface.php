<?php

namespace AdventOfCode\Day2;

interface RuleInterface
{
    public function isValid(string $password): bool;
}

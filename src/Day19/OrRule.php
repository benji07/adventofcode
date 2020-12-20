<?php

namespace AdventOfCode\Day19;

class OrRule implements Rule
{
    public function __construct(
        /** @var Rule[] */
        private array $rulesToMatches
    ) {
    }

    public function isValid(string $string, int &$index = 0): bool
    {
        $previousIndex = $index;
        foreach ($this->rulesToMatches as $i => $rule) {
            if ($rule->isValid($string, $index)) {
                return true;
            }
        }

        $index = $previousIndex;

        return false;
    }

    public function asString(int $deep): string
    {
        return '(' . implode(
                '|',
                array_map(fn(Rule $rule): string => $rule->asString($deep - 1), $this->rulesToMatches)
            ) . ')';
    }
}

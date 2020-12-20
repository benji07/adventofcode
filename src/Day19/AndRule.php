<?php

namespace AdventOfCode\Day19;

class AndRule implements Rule
{
    public function __construct(
        private RuleCollection $ruleCollection,
        /** @var int[] */
        private array $rulesToMatches
    ) {
    }

    public function isValid(string $string, int &$index = 0): bool
    {
        $firstIndex = $index;
        foreach ($this->rulesToMatches as $i => $rule) {
            $index = $index + $i;
            if (!$this->ruleCollection->rules[$rule]->isValid($string, $index)) {
                $index = $firstIndex;
                return false;
            }
        }

        return true;
    }

    public function asString(int $deep): string
    {
        if ($deep <= 0) {
            return 'x';
        }

        $textRepresentation = '';

        foreach ($this->rulesToMatches as $i => $rule) {
            $textRepresentation .= $this->ruleCollection->rules[$rule]->asString($deep - 1);
        }

        return '(' . $textRepresentation . ')';
    }
}

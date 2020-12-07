<?php

namespace AdventOfCode\Day7;

class Parser
{
    public array $constraints;
    public function __construct(string $data)
    {
        $this->constraints = [];

        $constraints = explode("\n", trim($data));

        foreach ($constraints as $constraint) {
            [$color, $rulePart] = explode(' bags contain ', $constraint);
            $this->constraints[$color] = [];

            if ($rulePart === 'no other bags.') {
                // cant contains anythings
                continue;
            }

            $rules = explode(', ', trim($rulePart, '.'));
            foreach ($rules as $rule) {
                $rule = trim(str_replace([' bags', ' bag'], '', $rule));
                [$amount, $destColor] = explode(' ', $rule , 2);

                $this->constraints[$color][$destColor] = $amount;
            }

        }
    }

    public function countBags(string $search): int
    {
        $found = 0;

        foreach ($this->constraints as $color => $contains) {
            if ($this->find($search, array_keys($contains))) {
                $found++;
            }
        }

        return $found;
    }

    protected function find(string $search, array $contains): bool
    {
        if (count($contains) === 0) {
            return false;
        }

        if (in_array($search, $contains, true)) {
            return true;
        }

        $children = [];
        foreach ($contains as $color) {
            $children = array_merge($children, array_keys($this->constraints[$color]));
        }

        return $this->find($search, $children);
    }

    public function containsBags(string $bag): int
    {
        if (count($this->constraints[$bag]) === 0) {
            return 0;
        }

        $contain = 0;
        foreach ($this->constraints[$bag] as $sub => $count) {
            $contain += ($this->containsBags($sub) + 1) * $count;
        }

        return $contain;
    }
}

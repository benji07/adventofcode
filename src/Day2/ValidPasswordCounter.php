<?php

namespace AdventOfCode\Day2;

class ValidPasswordCounter
{
    /** @var callable */
    private $ruleFactory;

    public function __construct(callable $ruleFactory)
    {
        $this->ruleFactory = $ruleFactory;
    }

    public function count(iterable $inputs): int
    {
        $result = 0;

        foreach ($inputs as $input) {
            [$min, $max, $letter, $password] = sscanf($input, '%d-%d %1s: %s');

            $rule = ($this->ruleFactory)($min, $max, $letter);

            if ($rule->isValid($password)) {
                $result++;
            }
        }

        return $result;
    }
}

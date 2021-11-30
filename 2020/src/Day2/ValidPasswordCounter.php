<?php

declare(strict_types=1);

namespace AdventOfCode\Day2;

class ValidPasswordCounter
{
    private RuleFactoryInterface $ruleFactory;

    public function __construct(RuleFactoryInterface $ruleFactory)
    {
        $this->ruleFactory = $ruleFactory;
    }

    /**
     * @param iterable<string> $inputs
     */
    public function count(iterable $inputs): int
    {
        $result = 0;

        foreach ($inputs as $input) {
            [$min, $max, $letter, $password] = sscanf($input, '%d-%d %1s: %s');

            $rule = $this->ruleFactory->create($min, $max, $letter);

            if ($rule->isValid($password)) {
                ++$result;
            }
        }

        return $result;
    }
}

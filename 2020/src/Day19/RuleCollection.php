<?php

declare(strict_types=1);

namespace AdventOfCode\Day19;

class RuleCollection
{
    /** @var Rule[] */
    public array $rules;

    public function __construct(array $rules)
    {
        foreach ($rules as $rule) {
            [$index, $constraints] = explode(': ', $rule);

            $this->set($index, $constraints);
        }
    }

    public function validate($string): bool
    {
        return 1 === preg_match($this->getRegex(), $string, $matches);
    }

    public function countMatches(array $tests): int
    {
        return \count(array_filter($tests, fn (string $test): bool => $this->validate($test)));
    }

    public function getRegex(): string
    {
        return '/^' . $this->rules[0]->asString(15) . '$/';
    }

    public function set(int $index, string $constraints): void
    {
        if (str_contains($constraints, '"')) {
            $this->rules[$index] = new SimpleRule(trim($constraints, '"'));

            return;
        }

        if (str_contains($constraints, '|')) {
            $this->rules[$index] = new OrRule(array_map(
                fn (string $constraint) => new AndRule($this, array_map('intval', explode(' ', $constraint))),
                explode(' | ', $constraints)
            ));

            return;
        }

        $this->rules[$index] = new AndRule($this, array_map('intval', explode(' ', $constraints)));
    }
}

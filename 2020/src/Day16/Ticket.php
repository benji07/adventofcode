<?php

declare(strict_types=1);

namespace AdventOfCode\Day16;

class Ticket
{
    /** @var int[] */
    public array $values;

    public function __construct(int ...$values)
    {
        $this->values = $values;
    }

    public static function createFromString(string $ticket): self
    {
        return new self(...array_map('intval', explode(',', $ticket)));
    }

    public function isValid(Rule ...$rules): bool
    {
        return \count($this->getInvalidValues(...$rules)) === 0;
    }

    public function getInvalidValues(Rule ...$rules): array
    {
        $invalidValues = [];
        foreach ($this->values as $value) {
            $valid = false;
            foreach ($rules as $rule) {
                if ($rule->isValid($value)) {
                    $valid = true;

                    break;
                }
            }

            if (!$valid) {
                $invalidValues[] = $value;
            }
        }

        return $invalidValues;
    }

    public function getDetail(array $mapping = []): array
    {
        return array_combine($mapping, $this->values);
    }
}

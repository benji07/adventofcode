<?php

declare(strict_types=1);

namespace AdventOfCode\Day9;

class XmasCipher
{
    public function getInvalid(int $preambleSize, array $data): ?int
    {
        $dataToValidate = array_values(\array_slice($data, $preambleSize));

        foreach ($dataToValidate as $i => $value) {
            $preamble = \array_slice($data, $i, $preambleSize);

            if (!$this->isValid($preamble, $value)) {
                return $value;
            }
        }

        return null;
    }

    public function isValid(array $preamble, int $value): bool
    {
        foreach ($preamble as $index => $firstValue) {
            $result = array_search($value - $firstValue, $preamble, true);
            if ($result !== false && $result !== $index) {
                return true;
            }
        }

        return false;
    }

    public function findEncryptionWeekness(array $data, int $invalidInput): int
    {
        $length = \count($data);

        for ($i = 0; $i < $length; ++$i) {
            $item = $data[$i];
            $sum = $item;

            for ($j = $i + 1; $j < $length; ++$j) {
                $sum += $data[$j];

                if ($sum === $invalidInput) {
                    $values = \array_slice($data, $i, $j - $i + 1);

                    return min(...$values) + max(...$values);
                }
            }
        }

        return 0;
    }
}

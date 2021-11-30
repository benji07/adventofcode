<?php

declare(strict_types=1);

namespace AdventOfCode\Day14;

class ChipDecoderV2 extends ChipDecoder
{
    protected function getDestinationAddresses(int $address): iterable
    {
        $valueAsString = sprintf('%036b', $address);
        $mask = $this->mask;
        for ($i = 0; $i < \strlen($mask); ++$i) {
            if ($mask[$i] === '0') {
                $mask[$i] = $valueAsString[$i];
            }
        }

        yield from $this->resolveMask($mask);
    }

    protected function getDestinationValue(int $value): int
    {
        return $value;
    }

    public function resolveMask(string $mask): iterable
    {
        if (substr_count($mask, 'X') === 0) {
            yield bindec($mask);

            return;
        }

        $position = (int) strpos($mask, 'X');

        yield from $this->resolveMask(substr_replace($mask, '0', $position, 1));
        yield from $this->resolveMask(substr_replace($mask, '1', $position, 1));
    }
}

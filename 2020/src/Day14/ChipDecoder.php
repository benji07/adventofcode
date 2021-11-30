<?php

declare(strict_types=1);

namespace AdventOfCode\Day14;

class ChipDecoder
{
    public string $mask = '';

    public function __construct(public array $memory = [])
    {
    }

    public function readAsArray(array $inputs): void
    {
        foreach ($inputs as $input) {
            $this->read($input);
        }
    }

    public function read(string $input): void
    {
        if (str_starts_with($input, 'mask')) {
            sscanf($input, 'mask = %s', $this->mask);

            return;
        }

        if (str_starts_with($input, 'mem[')) {
            [$address, $value] = sscanf($input, 'mem[%d] = %d');

            $this->write($address, $value);
        }
    }

    public function write(int $address, int $value): void
    {
        $destinationValue = $this->getDestinationValue($value);

        foreach ($this->getDestinationAddresses($address) as $destinationAddress) {
            $this->memory[$destinationAddress] = $destinationValue;
        }
    }

    public function getMemorySum(): int
    {
        return (int) array_sum($this->memory);
    }

    protected function getDestinationAddresses(int $address): iterable
    {
        return [$address];
    }

    protected function getDestinationValue(int $value): int
    {
        $valueAsString = sprintf('%036b', $value);

        for ($i = 0; $i < \strlen($this->mask); ++$i) {
            if ($this->mask[$i] === '1') {
                $valueAsString[$i] = '1';
            } elseif ($this->mask[$i] === '0') {
                $valueAsString[$i] = '0';
            }
        }

        return (int) bindec($valueAsString);
    }
}

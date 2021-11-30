<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared;

use Benji07\AdventOfCode\Shared\IntcodeComputer\EndOfProgramException;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

class IntcodeComputer
{
    /** @var int[] */
    private array $initialMemory;

    /** @var int[] */
    public array $memory;

    /** @var int[] */
    public array $input;

    private bool $throwException;

    private bool $breakOnOutput;

    private int $index;

    public function __construct(array $memory, bool $throwException = false, bool $breakOnOutput = false)
    {
        $this->initialMemory = $memory;
        $this->memory = $memory;
        $this->throwException = $throwException;
        $this->breakOnOutput = $breakOnOutput;
        $this->index = 0;
    }

    public function reset(): void
    {
        $this->index = 0;
        $this->memory = $this->initialMemory;
    }

    public function get(int $address): int
    {
        return $this->memory[$address];
    }

    public function getCurrent(): int
    {
        return $this->memory[$this->index];
    }

    public function getNext(): int
    {
        return $this->memory[++$this->index];
    }

    public function set(int $address, int $value): void
    {
        $this->memory[$address] = $value;
    }

    public function resolve(?int $noun = null, ?int $verb = null): string
    {
        $output = '';

        if ($noun !== null) {
            $this->set(1, $noun);
        }

        if ($verb !== null) {
            $this->set(2, $verb);
        }

        try {
            do {
                $operation = Operation::create($this);
                $operation->apply($output);

                $this->getNext();

                if ($operation instanceof Operation\Output && $this->breakOnOutput) {
                    return $output;
                }
            } while (true);
        } catch (EndOfProgramException $exception) {
            if ($this->throwException) {
                throw $exception;
            }
        }

        return $output;
    }

    /**
     * @return int[] [$noun, $verb]
     */
    public function findInput(int $output): array
    {
        for ($noun = 0; $noun <= 99; ++$noun) {
            for ($verb = 0; $verb <= 99; ++$verb) {
                $this->reset();
                $this->resolve($noun, $verb);

                if ($this->memory[0] === $output) {
                    return [$noun, $verb];
                }
            }
        }
    }

    /**
     * @param int|int[] $input
     */
    public function setInput($input): void
    {
        $this->input = is_array($input) ? $input : [$input];
    }

    public function getInput(): int
    {
        return array_shift($this->input) ?? 0;
    }

    public function memoryJump(int $index): void
    {
        $this->index = $index;
    }
}

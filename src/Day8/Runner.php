<?php

namespace AdventOfCode\Day8;

class Runner
{
    /** @var \ArrayIterator<int, Instruction> */
    public \ArrayIterator $instructions;

    public int $accumulator = 0;

    /**
     * @param Instruction[] $instructions
     */
    public function __construct(array $instructions)
    {
        $this->instructions = new \ArrayIterator($instructions);
    }

    public static function createFromString(string $input): self
    {
        $instructions = array_map(
            fn(string $instruction): Instruction => new Instruction(...(array) sscanf($instruction, "%s %d")),
            explode("\n", trim($input))
        );

        return new self($instructions);
    }

    public function run(bool $stopOnLoop = true): int
    {
        $executed = [];
        $this->accumulator = 0;

        while ($this->instructions->valid()) {
            $instruction = $this->instructions->current();

            $key = $this->instructions->key();

            if ($stopOnLoop) {
                if (in_array($key, $executed, true)) {
                    return 0;
                }

                $executed[] = $key;
            }

            switch ($instruction->type) {
                case 'acc':
                    $this->accumulator += $instruction->value;
                case 'nop':
                    $this->instructions->next();
                    break;
                case 'jmp':
                    try {
                        $this->instructions->seek($key + $instruction->value);
                    } catch (\OutOfBoundsException $exception) {
                        // jump after the last instruction
                        return 1;
                    }

                    break;
            }
        }

        return 1;
    }

    public function mutate(string $fromInstruction, string $toInstruction): int
    {
        $copyInstructions = new \ArrayIterator($this->instructions->getArrayCopy());
        foreach ($copyInstructions as $i => $instruction) {
            if ($instruction->type !== $fromInstruction && $instruction->type !== $toInstruction ) {
                continue;
            }

            /** @var Instruction $instructionToChange */
            $instructionToChange = $this->instructions[$i];

            $instructionToChange->type = $instructionToChange->type === $toInstruction ? $fromInstruction : $toInstruction;

            if (1 === $this->run(true)) {
                return $this->accumulator;
            }

            $instructionToChange->type = $instructionToChange->type === $toInstruction ? $fromInstruction : $toInstruction;
            $this->instructions->rewind();
        }

        return 0;
    }
}

<?php

namespace AdventOfCode\Day4;

class SmartPassportParser extends PassportParser
{
    private FieldFactory $fieldFactory;

    public function __construct(FieldFactory $fieldFactory)
    {
        $this->fieldFactory = $fieldFactory;
    }

    public function parse(string $data): Passport
    {
        $chunks = preg_split(pattern: '/\s+/', subject: $data, flags: PREG_SPLIT_NO_EMPTY);

        if ($chunks === false) {
            throw new \RuntimeException('Unable to split chunks');
        }

        return new Passport(
            ...array_map(
                fn($chunk): Field => $this->fieldFactory->create(...explode(':', $chunk)),
                $chunks
            )
        );
    }
}

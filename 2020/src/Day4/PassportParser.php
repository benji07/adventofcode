<?php

declare(strict_types=1);

namespace AdventOfCode\Day4;

class PassportParser
{
    public function parse(string $data): Passport
    {
        $chunks = preg_split(pattern: '/\s+/', subject: $data, flags: PREG_SPLIT_NO_EMPTY);

        if ($chunks === false) {
            throw new \RuntimeException('Unable to split chunks');
        }

        return new Passport(
            ...array_map(
                fn ($chunk): Field => new Field(...explode(':', $chunk)),
                $chunks
            )
        );
    }
}

<?php

namespace AdventOfCode\Day4;

class PassportCollectionParser
{
    private PassportParser $passportParser;

    public function __construct(PassportParser $passportParser)
    {
        $this->passportParser = $passportParser;
    }

    /**
     * @return Passport[]
     */
    public function parse(string $data): array
    {
        $passports = explode("\n\n", $data);

        return array_map(fn($passport): Passport => $this->passportParser->parse($passport), $passports);
    }
}

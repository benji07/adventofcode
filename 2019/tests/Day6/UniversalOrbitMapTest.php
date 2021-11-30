<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day6;

use Benji07\AdventOfCode\Day6\UniversalOrbitMap;
use PHPUnit\Framework\TestCase;

class UniversalOrbitMapTest extends TestCase
{
    public function testCount()
    {
        $input = [
            'COM)B',
            'B)C',
            'C)D',
            'D)E',
            'E)F',
            'B)G',
            'G)H',
            'D)I',
            'E)J',
            'J)K',
            'K)L',
        ];

        $orbitCounter = new UniversalOrbitMap($input);

        $this->assertEquals(42, $orbitCounter->count());
    }

    public function testPart1(): void
    {
        $dump = $this->getData();

        $orbitCounter = new UniversalOrbitMap($dump);

        $this->assertEquals(271151, $orbitCounter->count());
    }

    public function testCountOrbitalTransfert()
    {
        $input = [
            'COM)B',
            'B)C',
            'C)D',
            'D)E',
            'E)F',
            'B)G',
            'G)H',
            'D)I',
            'E)J',
            'J)K',
            'K)L',
            'K)YOU',
            'I)SAN',
        ];

        $orbitCounter = new UniversalOrbitMap($input);

        $this->assertEquals(4, $orbitCounter->countOrbitalTransfert('YOU', 'SAN'));
    }

    public function testPart2(): void
    {
        $dump = $this->getData();

        $orbitCounter = new UniversalOrbitMap($dump);

        $this->assertEquals(388, $orbitCounter->countOrbitalTransfert('YOU', 'SAN'));
    }

    /**
     * @return string[]
     */
    protected function getData(): array
    {
        $dump = file(__DIR__ . '/data/input.txt');

        if ($dump === false) {
            $this->fail('Invalid file');

            return [];
        }

        return $dump;
    }
}

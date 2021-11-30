<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day6;

class UniversalOrbitMap
{
    /** @var Orbit[] */
    public array $orbits = [];

    /**
     * @param string[] $orbits
     */
    public function __construct(array $orbits = [])
    {
        foreach ($orbits as $orbit) {
            [$from, $to] = explode(')', trim($orbit));

            if (!array_key_exists($to, $this->orbits)) {
                $this->orbits[$to] = new Orbit($to);
            }

            if (!array_key_exists($from, $this->orbits)) {
                $this->orbits[$from] = new Orbit($from);
            }

            $this->orbits[$from]->addChild($this->orbits[$to]);
        }
    }

    public function count(): int
    {
        return (int) array_sum(array_map(static function (Orbit $orbit) {
            return $orbit->count();
        }, $this->orbits));
    }

    public function countOrbitalTransfert(string $from, string $to): int
    {
        $parentsFrom = $this->orbits[$from]->getParents();
        $parentsTo = $this->orbits[$to]->getParents();

        $intersectOrbit = array_values(array_intersect($parentsFrom, $parentsTo))[0];

        return (int) array_search($intersectOrbit, $parentsFrom) + (int) array_search($intersectOrbit, $parentsTo);
    }
}

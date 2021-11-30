<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day6;

class Orbit
{
    private string $name;

    /**
     * @var array|Orbit[]
     */
    private array $children;

    /** @var Orbit|null */
    private ?Orbit $parent = null;

    /**
     * @param Orbit[] $children
     */
    public function __construct(string $name, array $children = [])
    {
        $this->name = $name;
        $this->children = $children;

        foreach ($children as $child) {
            $this->addChild($child);
        }
    }

    public function addChild(Orbit $orbit): void
    {
        $this->children[] = $orbit;
        $orbit->setParent($this);
    }

    public function setParent(Orbit $orbit)
    {
        $this->parent = $orbit;
    }

    /**
     * @return Orbit[]
     */
    public function getParents(): array
    {
        if ($this->parent === null) {
            return [];
        }

        return array_merge([$this->parent], $this->parent->getParents());
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function count(): int
    {
        if ($this->parent !== null) {
            return $this->parent->count() + 1;
        }

        return 0;
    }
}

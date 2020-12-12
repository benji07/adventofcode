<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day7;

use AdventOfCode\Day7\Parser;
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    public function testSamplePart1(): void
    {
        $input = <<<DATA
light red bags contain 1 bright white bag, 2 muted yellow bags.
dark orange bags contain 3 bright white bags, 4 muted yellow bags.
bright white bags contain 1 shiny gold bag.
muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
dark olive bags contain 3 faded blue bags, 4 dotted black bags.
vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
faded blue bags contain no other bags.
dotted black bags contain no other bags.
DATA;

        $parser = new Parser($input);

        self::assertEquals(4, $parser->countBags('shiny gold'));
    }

    public function testPart1(): void
    {
        $input = file_get_contents(__DIR__ . '/input.txt');

        $parser = new Parser($input);

        self::assertEquals(119, $parser->countBags('shiny gold'));
    }

    public function testSamplePart2(): void
    {
        $input = <<<DATA
light red bags contain 1 bright white bag, 2 muted yellow bags.
dark orange bags contain 3 bright white bags, 4 muted yellow bags.
bright white bags contain 1 shiny gold bag.
muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
dark olive bags contain 3 faded blue bags, 4 dotted black bags.
vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
faded blue bags contain no other bags.
dotted black bags contain no other bags.
DATA;

        $parser = new Parser($input);

        self::assertEquals(0, $parser->containsBags('faded blue'));
        self::assertEquals(0, $parser->containsBags('dotted black'));
        self::assertEquals(11, $parser->containsBags('vibrant plum'));
        self::assertEquals(7, $parser->containsBags('dark olive'));
        self::assertEquals(32, $parser->containsBags('shiny gold'));

        $input = <<<DATA
shiny gold bags contain 2 dark red bags.
dark red bags contain 2 dark orange bags.
dark orange bags contain 2 dark yellow bags.
dark yellow bags contain 2 dark green bags.
dark green bags contain 2 dark blue bags.
dark blue bags contain 2 dark violet bags.
dark violet bags contain no other bags.
DATA;
        $parser = new Parser($input);
        self::assertEquals(126, $parser->containsBags('shiny gold'));
    }

    public function testPart2(): void
    {
        $input = file_get_contents(__DIR__ . '/input.txt');

        $parser = new Parser($input);

        self::assertEquals(155_802, $parser->containsBags('shiny gold'));
    }
}

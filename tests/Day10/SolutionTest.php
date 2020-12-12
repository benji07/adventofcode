<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day10;

use AdventOfCode\Day10\ArrayAdapter;
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    public function testSample1(): void
    {
        $input = <<<INPUT
16
10
15
5
1
11
7
19
6
12
4
INPUT;

        self::assertEquals(35, (new ArrayAdapter($input))->getDifferences());
    }

    public function testLargerSample1(): void
    {
        $input = <<<INPUT
28
33
18
42
31
14
46
20
48
47
24
23
49
45
19
38
39
11
1
32
25
35
8
17
7
9
4
2
34
10
3
INPUT;

        self::assertEquals(220, (new ArrayAdapter($input))->getDifferences());
    }

    public function testPart1(): void
    {
        $input = file_get_contents(__DIR__ . '/input.txt');

        self::assertEquals(2210, (new ArrayAdapter($input))->getDifferences());
    }

    public function testSample2(): void
    {
        $input = <<<INPUT
16
10
15
5
1
11
7
19
6
12
4
INPUT;

        self::assertEquals(8, (new ArrayAdapter($input))->countArrangements());
    }

    public function testLargerSample2(): void
    {
        $input = <<<INPUT
28
33
18
42
31
14
46
20
48
47
24
23
49
45
19
38
39
11
1
32
25
35
8
17
7
9
4
2
34
10
3
INPUT;

        self::assertEquals(19_208, (new ArrayAdapter($input))->countArrangements());
    }

    public function testPart2(): void
    {
        $input = file_get_contents(__DIR__ . '/input.txt');

        self::assertEquals(7_086_739_046_912, (new ArrayAdapter($input))->countArrangements());
    }
}

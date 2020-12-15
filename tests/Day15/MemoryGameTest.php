<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day15;

use AdventOfCode\Day15\MemoryGame;
use PHPUnit\Framework\TestCase;

class MemoryGameTest extends TestCase
{
    /**
     * @param int[] $input
     *
     * @dataProvider provideTestGetNumberAt
     */
    public function testGetNumberAt(array $input, int $turn, int $expectedResult): void
    {
        $game = new MemoryGame($input);
        self::assertEquals($expectedResult, $game->getNumberAt($turn));
    }

    public function provideTestGetNumberAt(): iterable
    {
        yield [[0, 3, 6], 1, 0];
        yield [[0, 3, 6], 2, 3];
        yield [[0, 3, 6], 3, 6];
        yield [[0, 3, 6], 4, 0];
        yield [[0, 3, 6], 5, 3];
        yield [[0, 3, 6], 6, 3];
        yield [[0, 3, 6], 7, 1];
        yield [[0, 3, 6], 8, 0];
        yield [[0, 3, 6], 9, 4];
        yield [[0, 3, 6], 10, 0];

        yield 'sample 1' => [[0, 3, 6], 2020, 436];

        yield [[1, 3, 2], 2020, 1];
        yield [[2, 1, 3], 2020, 10];
        yield [[1, 2, 3], 2020, 27];
        yield [[2, 3, 1], 2020, 78];
        yield [[3, 2, 1], 2020, 438];
        yield [[3, 1, 2], 2020, 1836];

        yield 'part 1' => [[0, 13, 1, 16, 6, 17], 2020, 234];

//        yield [[0,3,6], 30000000, 175594];
//        yield [[1,3,2], 30000000, 2578];
//        yield [[2,1,3], 30000000, 3544142];
//        yield [[1,2,3], 30000000, 261214];
//        yield [[2,3,1], 30000000, 6895259];
//        yield [[3,2,1], 30000000, 18];
//        yield [[3,1,2], 30000000, 362];
//
//        yield "part 2" => [[0, 13, 1, 16, 6, 17], 30000000, 234];
    }
}

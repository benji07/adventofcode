<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Day22;

use AdventOfCode\Day22\Combat;
use AdventOfCode\Day22\RecursiveCombat;
use PHPUnit\Framework\TestCase;

class CombatTest extends TestCase
{
    public function testSample1(): void
    {
        $combat = new Combat([9, 2, 6, 3, 1], [5, 8, 4, 7, 10]);
        $winner = $combat->play();

        self::assertCount(0, $combat->player1);
        self::assertCount(10, $combat->player2);
        self::assertEquals(29, $combat->round);

        self::assertEquals(2, $winner);
        self::assertEquals(306, $combat->getScore());
    }

    public function testPart1(): void
    {
        $input = file_get_contents(__DIR__ . '/input.txt');

        [$player1, $player2] = explode("\n\n", trim($input));
        [, $player1] = explode("\n", $player1, 2);
        [, $player2] = explode("\n", $player2, 2);
        $player1 = array_map('intval', explode("\n", $player1));
        $player2 = array_map('intval', explode("\n", $player2));

        $combat = new Combat($player1, $player2);
        $combat->play();

        self::assertEquals(34_566, $combat->getScore());
    }

    public function testSample2(): void
    {
        $combat = new RecursiveCombat([9, 2, 6, 3, 1], [5, 8, 4, 7, 10]);
        $winner = $combat->play();

        self::assertCount(0, $combat->player1);
        self::assertCount(10, $combat->player2);
        self::assertEquals(17, $combat->round);
        self::assertEquals([7, 5, 6, 2, 4, 1, 10, 8, 9, 3], $combat->player2);

        self::assertEquals(2, $winner);
        self::assertEquals(291, $combat->getScore());
    }

    public function testPart2(): void
    {
        $input = file_get_contents(__DIR__ . '/input.txt');

        [$player1, $player2] = explode("\n\n", trim($input));
        [, $player1] = explode("\n", $player1, 2);
        [, $player2] = explode("\n", $player2, 2);
        $player1 = array_map('intval', explode("\n", $player1));
        $player2 = array_map('intval', explode("\n", $player2));

        $combat = new RecursiveCombat($player1, $player2);
        $combat->play();

        self::assertEquals(0, $combat->getScore());
    }
}

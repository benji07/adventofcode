<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day5;

use Benji07\AdventOfCode\Shared\IntcodeComputer\Opcode;
use PHPUnit\Framework\TestCase;

class OpcodeTest extends TestCase
{
    public function testCreate(): void
    {
        $opcode = new Opcode(1);

        $this->assertEquals(Opcode::ACTION_ADD, $opcode->action);
        $this->assertEquals(Opcode::MODE_POSITION, $opcode->mode[0]);
        $this->assertEquals(Opcode::MODE_POSITION, $opcode->mode[1]);
        $this->assertEquals(Opcode::MODE_POSITION, $opcode->mode[2]);

        $opcode = new Opcode(101);

        $this->assertEquals(Opcode::ACTION_ADD, $opcode->action);
        $this->assertEquals(Opcode::MODE_IMMEDIATE, $opcode->mode[0]);
        $this->assertEquals(Opcode::MODE_POSITION, $opcode->mode[1]);
        $this->assertEquals(Opcode::MODE_POSITION, $opcode->mode[2]);
    }
}

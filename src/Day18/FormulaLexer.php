<?php

namespace AdventOfCode\Day18;

use Doctrine\Common\Lexer\AbstractLexer;

class FormulaLexer extends AbstractLexer
{
    const T_NUMBER = 1;
    const T_PLUS = 2;
    const T_MULTIPLY = 3;
    const T_OPEN_PARENTHESIS = 4;
    const T_CLOSE_PARENTHESIS = 5;

    protected function getCatchablePatterns()
    {
        return [
            '\d+',
            '[*+]',
            '[\(\)]'
        ];
    }

    protected function getNonCatchablePatterns()
    {
        return [' '];
    }

    protected function getType(&$value)
    {
        return match ($value) {
            '+' => self::T_PLUS,
            '*' => self::T_MULTIPLY,
            '(' => self::T_OPEN_PARENTHESIS,
            ')' => self::T_CLOSE_PARENTHESIS,
            default => self::T_NUMBER
        };
    }
}

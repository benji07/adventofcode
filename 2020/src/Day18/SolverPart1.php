<?php

declare(strict_types=1);

namespace AdventOfCode\Day18;

class SolverPart1
{
    protected FormulaLexer $lexer;

    public function __construct()
    {
        $this->lexer = new FormulaLexer();
    }

    public function solve(string $formula): int
    {
        $this->lexer->setInput($formula);
        $this->lexer->moveNext();

        // Formula := Term (Operator Term)*
        // Term := Number | OPEN_PARENTHESIS (Formula) CLOSE_PARENTHESIS

        return $this->Formula();
    }

    public function Term(): int
    {
        if ($this->lexer->isNextToken(FormulaLexer::T_NUMBER)) {
            return (int) $this->lexer->lookahead['value'];
        }

        if ($this->lexer->isNextToken(FormulaLexer::T_OPEN_PARENTHESIS)) {
            $this->lexer->moveNext();

            $value = $this->Formula();

            return $value;
        }

        throw new \Exception('Parse error');
    }

    public function Formula(): int
    {
        $leftValue = $this->Term();
        $this->lexer->moveNext();

        do {
            if (!$this->lexer->isNextTokenAny([FormulaLexer::T_MULTIPLY, FormulaLexer::T_PLUS])) {
                return $leftValue;
            }

            $operation = $this->lexer->lookahead['type'];
            $this->lexer->moveNext();
            $rightValue = $this->Term();

            $leftValue = match ($operation) {
                FormulaLexer::T_PLUS => $leftValue + $rightValue,
                FormulaLexer::T_MULTIPLY => $leftValue * $rightValue,
            };
        } while ($this->lexer->moveNext() && !$this->lexer->isNextToken(FormulaLexer::T_CLOSE_PARENTHESIS));

        return $leftValue;
    }
}

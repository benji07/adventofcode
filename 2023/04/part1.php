<?php

$input = file('input.txt');

/** @var Card[] $cards */
$cards = array_map(Card::fromString(...), $input);

foreach ($cards as $card) {
    echo $card->index, ' -> ', $card->getScore(), "\n";
}

var_dump(array_sum(array_map(fn (Card $card) => $card->getScore(), $cards)));

class Card
{
    /**
     * @param int[] $winningNumbers
     * @param int[] $numbers
     */
    public function __construct(
        public readonly int $index,
        public readonly array $winningNumbers,
        public readonly array $numbers
    ) {
    }

    public function getScore(): int
    {
        $foundNumbers = array_intersect($this->numbers, $this->winningNumbers);

        if (count($foundNumbers) === 0) {
            return 0;
        }

        if (count($foundNumbers) === 1) {
            return 1;
        }

        return pow(2, count($foundNumbers) - 1);
    }

    public static function fromString(string $input): self
    {
        [$index, $numbers] = explode(': ', substr($input, strlen('Card ')));

        [$winningNumbers, $numbers] = explode('|', $numbers);

        return new self(
            (int) $index,
            array_map('intval', array_map('trim', array_filter(explode(' ', $winningNumbers)))),
            array_map('intval', array_map('trim', array_filter(explode(' ', $numbers))))
        );
    }
}

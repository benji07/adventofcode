<?php

$input = file('input.txt');

/** @var Card[] $cards */
$cards = array_map(Card::fromString(...), $input);

$scratchcards = array_fill(1, count($cards), 1);

foreach ($cards as $card) {

    $nbMatchingNumbers = count($card->getMatchingNumbers());

    for ($i = $card->index; $i < $card->index + $nbMatchingNumbers; $i++) {
        $scratchcards[$i + 1] += $scratchcards[$card->index];
    }
}

var_dump(array_sum($scratchcards));

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
        $matchingNumbers = $this->getMatchingNumbers();

        if (count($matchingNumbers) === 0) {
            return 0;
        }

        if (count($matchingNumbers) === 1) {
            return 1;
        }

        return pow(2, count($matchingNumbers) - 1);
    }

    /**
     * @return int[]
     */
    public function getMatchingNumbers(): array
    {
        return array_intersect($this->numbers, $this->winningNumbers);
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

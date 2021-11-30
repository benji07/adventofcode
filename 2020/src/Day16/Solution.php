<?php

declare(strict_types=1);

namespace AdventOfCode\Day16;

class Solution
{
    /** @var Rule[] */
    private array $rules;

    private Ticket $myTicket;

    /** @var Ticket[] */
    private array $tickets;

    public function __construct(string $input)
    {
        [$rules, $myTicket, $tickets] = explode("\n\n", $input);

        $this->rules = array_map(
            static function ($rule): Rule {
                return Rule::createFromString($rule);
            },
            explode("\n", $rules)
        );
        [, $myTicket] = explode("\n", $myTicket);

        $this->myTicket = Ticket::createFromString($myTicket);
        $this->tickets = array_map(fn ($value): Ticket => Ticket::createFromString($value), \array_slice(explode("\n", $tickets), 1));
    }

    public function getPart1Solution(): int
    {
        return (int) array_sum(
            array_merge(
                ...array_map(
                    fn (Ticket $ticket): array => $ticket->getInvalidValues(...$this->rules),
                    $this->tickets
                )
            )
        );
    }

    /**
     * @return Ticket[]
     */
    private function getValidTickets(): array
    {
        return array_filter($this->tickets, fn (Ticket $ticket): bool => $ticket->isValid(...$this->rules));
    }

    public function getMyTicketDetail(): array
    {
        $validTickets = $this->getValidTickets();

        $mapping = $this->getMapping($validTickets);

        return $this->myTicket->getDetail($mapping);
    }

    public function getPart2Solution(): int
    {
        $detail = $this->getMyTicketDetail();

        return (int) array_product(
            array_filter(
                $detail,
                fn ($key) => str_starts_with($key, 'departure'),
                ARRAY_FILTER_USE_KEY
            )
        );
    }

    protected function getMapping(array $tickets): array
    {
        $matches = [];
        foreach ($tickets as $j => $ticket) {
            $matches[$j] = [];
            foreach ($ticket->values as $i => $value) {
                $matches[$j][] = array_map(
                    fn (Rule $rule): string => $rule->name,
                    array_filter($this->rules, fn (Rule $rule): bool => $rule->isValid($value))
                );
            }
        }

        $result = [];
        for ($i = 0; $i < \count($this->myTicket->values); ++$i) {
            $result[$i] = array_intersect(...array_column($matches, $i));
        }

        do {
            foreach ($result as $index => $item) {
                if (\count($item) === 1) {
                    // need to remove this from other ligne
                    $correct = current($item);

                    foreach ($result as $other => $otherFields) {
                        if ($other === $index) {
                            continue;
                        }

                        $result[$other] = array_filter($result[$other], fn ($value) => $value !== $correct);
                    }
                }
            }
        } while (\count($result, COUNT_RECURSIVE) > \count($result) * 2);

        foreach ($result as $index => $item) {
            $result[$index] = current($item);
        }

        return $result;
    }
}

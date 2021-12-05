<?php

declare(strict_types=1);

namespace AOC2021\Day05;

class Line
{
    public function __construct(
        public Point $start,
        public Point $end
    ) {
    }

    public static function fromString(string $input): self
    {
        sscanf($input, '%d,%d -> %d,%d', $x1, $y1, $x2, $y2);

        return new self(new Point($x1, $y1), new Point($x2, $y2));
    }

    public function isVertical(): bool
    {
        return $this->start->x === $this->end->x;
    }

    public function isHorizontal(): bool
    {
        return $this->start->y === $this->end->y;
    }

    public function isDiagonal(): bool
    {
        return !$this->isHorizontal() && !$this->isVertical();
    }

    /**
     * @return iterable<Point>
     */
    public function getPoints(): iterable
    {
        if ($this->isVertical() || $this->isHorizontal()) {
            foreach (range($this->start->x, $this->end->x) as $x) {
                foreach (range($this->start->y, $this->end->y) as $y) {
                    yield new Point($x, $y);
                }
            }
        } else {
            foreach (range($this->start->x, $this->end->x) as $offset => $x) {
                yield new Point($x, $this->start->y > $this->end->y ? $this->start->y - $offset : $this->start->y + $offset);
            }
        }
    }
}

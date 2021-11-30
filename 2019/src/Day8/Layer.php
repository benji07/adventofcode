<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day8;

class Layer
{
    /** @var string[] */
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function countChar(string $char): int
    {
        return count_chars(implode('', $this->data))[ord($char)];
    }

    public function stack(Layer $layer): Layer
    {
        $background = clone $this;

        foreach ($background->data as $i => $result) {
            $frontLayerArray = str_split($layer->data[$i]);

            foreach ($frontLayerArray as $j => $pixel) {
                switch ($pixel) {
                    case '2':
                        // transparent : do nothing
                        break;
                    case '1':
                    case '0':
                    $result[$j] = $pixel;
                        break;
                }
            }

            $background->data[$i] = $result;
        }

        return $background;
    }
}

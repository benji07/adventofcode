<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day8;

class LayersExtractor
{
    /**
     * @return Layer[]
     */
    public function extract(string $data, int $width, int $height): array
    {
        $lines = str_split($data, $width);

        if ($lines === false) {
            throw new \InvalidArgumentException();
        }

        $layers = [];
        $layer = [];
        foreach ($lines as $line) {
            $layer[] = $line;

            if (count($layer) === $height) {
                $layers[] = new Layer($layer);
                $layer = [];
            }
        }

        return $layers;
    }

    /**
     * @param Layer[] $layers
     *
     * @return Layer
     */
    public function findCorrectLayer(array $layers): ?Layer
    {
        $matchingNbO = null;
        $matchingLayer = null;

        foreach ($layers as $layer) {
            $nbO = $layer->countChar('0');

            if ($matchingNbO === null || $nbO < $matchingNbO) {
                $matchingNbO = $nbO;
                $matchingLayer = $layer;
            }
        }

        return $matchingLayer;
    }

    public function getSolution(Layer $layer): int
    {
        return $layer->countChar('1') * $layer->countChar('2');
    }
}

<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day8;

use Benji07\AdventOfCode\Day8\Layer;
use Benji07\AdventOfCode\Day8\LayersExtractor;
use PHPUnit\Framework\TestCase;

class LayersExtractorTest extends TestCase
{
    /**
     * @param string[][] $expectedLayers
     *
     * @dataProvider provideTestExtract
     */
    public function testExtract(string $input, int $width, int $height, array $expectedLayers): void
    {
        $extractor = new LayersExtractor();

        $this->assertEquals($expectedLayers, $extractor->extract($input, $width, $height));
    }

    public function provideTestExtract(): \Generator
    {
        yield [
            '123456789012',
            3,
            2,
            [new Layer(['123', '456']), new Layer(['789', '012'])],
        ];
    }

    public function testGetSolution(): void
    {
        $extractor = new LayersExtractor();

        $layers = $extractor->extract('123456789012', 3, 2);
        $layer = $extractor->findCorrectLayer($layers);

        if ($layer === null) {
            $this->fail('no layer');

            return;
        }

        $this->assertEquals(1, $extractor->getSolution($layer));
    }

    public function testPart1(): void
    {
        $input = file(__DIR__ . '/data/input.txt');

        $extractor = new LayersExtractor();

        $layers = $extractor->extract((string) $input[3], 25, 6);

        $layer = $extractor->findCorrectLayer($layers);

        if ($layer === null) {
            $this->fail('no layer');

            return;
        }

        $this->assertEquals(1935, $extractor->getSolution($layer));
    }

    public function testStack(): void
    {
        $extractor = new LayersExtractor();

        $layers = $extractor->extract('0222112222120000', 2, 2);

        $resultLayer = null;
        foreach (array_reverse($layers) as $layer) {
            if ($resultLayer === null) {
                $resultLayer = $layer;

                continue;
            }

            $resultLayer = $resultLayer->stack($layer);
        }

        $this->assertEquals(new Layer(['01', '10']), $resultLayer);
    }

    public function testPart2(): void
    {
        $input = file(__DIR__ . '/data/input.txt');

        $extractor = new LayersExtractor();

        $layers = $extractor->extract((string) $input[3], 25, 6);

        $resultLayer = null;
        foreach (array_reverse($layers) as $layer) {
            if ($resultLayer === null) {
                $resultLayer = $layer;

                continue;
            }

            $resultLayer = $resultLayer->stack($layer);
        }

        $this->assertEquals(
            new Layer(
                [
                    '0110011110100001001010000',
                    '1001010000100001001010000',
                    '1000011100100001001010000',
                    '1000010000100001001010000',
                    '1001010000100001001010000',
                    '0110010000111100110011110',
                ]
            ),
            $resultLayer
        );
    }
}

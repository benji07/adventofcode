<?php

$data = file_get_contents('input.txt');

$data = explode(' ', $data);

function extractMetadata($index, &$data): array
{
    $result = [
        'index' => chr(64 + $index),
        'nbChild' => 0,
        'nbMetadata' => 0,
        'localMetadata' => [],
        'metadata' => [],
        'children' => [],
        'sum' => 0
    ];

    if (!count($data)) {
        return $result;
    }

    $result['nbChild'] = array_shift($data);
    $result['nbMetadata'] = array_shift($data);

    if ($result['nbChild'] > 0) {
        for ($i = 0; $i < $result['nbChild']; $i++) {
            $result['children'][] = $r = extractMetadata(++$index, $data);
//            $result['metadata'] = array_merge($result['metadata'], $r['metadata']);
        }
    }

    $result['localMetadata'] = array_splice($data, 0, $result['nbMetadata']);

    if ($result['nbChild'] == 0) {
        $result['sum'] = array_sum($result['localMetadata']);
    } else {
        foreach ($result['localMetadata'] as $v) {
            if (array_key_exists($v - 1, $result['children'])) {
                $result['sum'] += $result['children'][$v - 1]['sum'];
            }
        }
    }

    echo $result['index'], ' - ', $result['nbChild'], ' - ', $result['nbMetadata'];
    echo ' - ', $result['sum'];
    echo "\n";

    return $result;
}

$metadata = extractMetadata(1, $data);
//var_dump($metadata);

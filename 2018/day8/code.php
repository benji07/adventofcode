<?php

$data = file_get_contents('input.txt');

$data = explode(' ', $data);

function extractMetadata($index, &$data): array
{
    if (!count($data)) {
        return [];
    }

    $metadata = [];
    $nbChildNodes = array_shift($data);
    $nbMetadataNodes = array_shift($data);

    if ($nbChildNodes > 0) {
        for ($i = 0; $i < $nbChildNodes; $i++) {
            $metadata = array_merge($metadata, extractMetadata(++$index, $data));
        }
    }

    return array_merge($metadata, array_splice($data, 0, $nbMetadataNodes));
}

$metadata = extractMetadata(1, $data);

echo array_sum($metadata);

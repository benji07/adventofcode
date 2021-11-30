<?php

$reducePolymer = $polymer = trim(file_get_contents('input.txt'));

function reduce($polymer): string
{
    $reducePolymer = $polymer;
    do {
        $polymer = $reducePolymer;
        $polymerArray = str_split($polymer);

        foreach ($polymerArray as $i => $letter) {
            if (!array_key_exists($i + 1, $polymerArray)) {
                continue;
            }

            $nextLetter = $polymerArray[$i + 1];
            if ($letter !== $nextLetter && strtolower($letter) === strtolower($nextLetter)) {
                unset($polymerArray[$i]);
                unset($polymerArray[$i + 1]);
                break;
            }
        }

        $reducePolymer = join('', $polymerArray);
    } while ($polymer !== $reducePolymer);

    return $reducePolymer;
}


$minLength = strlen($polymer);
foreach (range('a', 'z') as $letter) {
    echo $letter, ' - ';
    $reducePolymer = reduce(str_replace([$letter, strtoupper($letter)], '', $polymer));
    echo strlen($reducePolymer)."\n";
    $minLength = min($minLength, strlen($reducePolymer));
}

echo $minLength;

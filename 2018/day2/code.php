<?php

$lines = file('input.txt');

$sum = [
	2 => 0,
	3 => 0
];

// $lines = [
// 	'abcdef',
// 	'bababc',
// 	'abbcde',
// 	'abcccd',
// 	'aabcdd',
// 	'abcdee',
// 	'ababab',
// ];
$closest = [];
foreach ($lines as $line) {
	$found = [2 => false, 3 => false];
	foreach (count_chars($line, 1) as $i => $val) {
		if ($val < 2) {
			continue;
		}

		if ($val == 2) {
			$found[2] = true;
		}

		if ($val == 3) {
			$found[3] = true;
		}
	}

	if ($found[2]) {
		$sum[2]++;
	}

	if ($found[3]) {
		$sum[3]++;
	}

	foreach ($lines as $subline) {
		$result = levenshtein($line, $subline);

		$closest[$result] = [$line, $subline];
	}
}

ksort($closest);
unset($closest[0]);
var_dump(current($closest));

echo $sum[2] * $sum[3];


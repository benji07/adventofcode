<?php

$lines = file('input.txt');

$found = [];
$total = 0;
$firstFrequency = false;
do {
	foreach ($lines as $line) {
		sscanf($line, '%d', $value);
		$total += $value;


		if (in_array($total, $found)) {
			$firstFrequency = true;
			echo $total;
			return;
		} else {
			$found[] = (int) $total;
		}
	}
} while ($firstFrequency == false);
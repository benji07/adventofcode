<?php


function parse(string $filename): array
{
	$lines = file($filename);

	$steps = [];

	foreach ($lines as $line) {
		list($to, $from) = sscanf($line, 'Step %s must be finished before step %s can begin.');

		if (!array_key_exists($from, $steps)) {
			$steps[$from] = [];
		}

		if (!array_key_exists($to, $steps)) {
			$steps[$to] = [];
		}

		$steps[$from][] = $to;

	}

	ksort($steps);

	return $steps;
}

$steps = parse('input.txt');

$executedSteps = [];
$i = 0;

while (true) {
	$nextAvailables = [];
	foreach ($steps as $stepName => $requirements) {
		if (in_array($stepName, $executedSteps)) {
			continue;
		}

		$diff = array_diff($requirements, $executedSteps);
		if (count($diff) == 0) {
			$nextAvailables[] = $stepName;
		}
	}

	if (count($nextAvailables) == 0) {
		break;
	}
	sort($nextAvailables);
	$next = reset($nextAvailables);

	$executedSteps[] = $next;
}


echo implode('', $executedSteps);
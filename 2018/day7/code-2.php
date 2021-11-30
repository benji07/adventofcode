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

// $executedSteps = [];
// $i = 0;

// while (true) {
// 	$nextAvailables = [];
// 	foreach ($steps as $stepName => $requirements) {
// 		if (in_array($stepName, $executedSteps)) {
// 			continue;
// 		}

// 		$diff = array_diff($requirements, $executedSteps);
// 		if (count($diff) == 0) {
// 			$nextAvailables[] = $stepName;
// 		}
// 	}

// 	if (count($nextAvailables) == 0) {
// 		break;
// 	}
// 	sort($nextAvailables);
// 	$next = reset($nextAvailables);

// 	$executedSteps[] = $next;
// }


// echo implode('', $executedSteps);

function run (array $steps, int $worker = 1, int $baseTaskTime = 0): int
{
	$time = 0;
	$queue = [];
	$executedSteps = [];

	do {
		foreach ($queue as $stepName => $_) {
			$queue[$stepName]--;

			if ($queue[$stepName] == 0) {
				$executedSteps[] = $stepName;
				unset($queue[$stepName]);
			}
		}

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

		sort($nextAvailables);
		
		foreach ($nextAvailables as $stepName) {
			if (count($queue) < $worker && !array_key_exists($stepName, $queue)) {
				$queue[$stepName] = $baseTaskTime + ord($stepName) - 64;
			}
		}

		$time++;

	} while (count($nextAvailables) != 0 && count($queue) != 0);
var_dump($executedSteps);
	return $time - 1;
}

var_dump(run($steps, 5, 60));
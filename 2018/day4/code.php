<?php

class Interaction
{
    const SLEEP = 'sleep';
    const AWAKE = 'awake';
    const START = 'start';

    /** @var DateTime */
    public $date;

    /** @var int */
    public $guardId;

    /** @var string */
    public $action;

    public function __construct(string $info)
    {
        $this->date = new \DateTime(substr($info, 1, 16));

        $action = trim(substr($info, 19));

        switch ($action) {
            case 'falls asleep':
                $this->action = self::SLEEP;
                break;
            case 'wakes up':
                $this->action = self::AWAKE;
                break;
            default:
                $this->action = self::START;
                list($this->guardId) = sscanf($action, 'Guard #%d begins shift');
                break;
        }
    }
}

$lines = file('input.txt');

/** @var Interaction[] $interactions */
$interactions = [];

foreach ($lines as $line) {
    $interactions[] = new Interaction($line);
}

usort($interactions, function (Interaction $a, Interaction $b) {
    return $a->date <=> $b->date;
});

$result = [];

$guardId = null;
$start = new \DateTime();
foreach ($interactions as $interaction) {
    switch ($interaction->action) {
        case Interaction::START:
            $guardId = $interaction->guardId;
            break;
        case Interaction::SLEEP:
            $start = $interaction->date;
            break;
        case Interaction::AWAKE:
            if (!array_key_exists($guardId, $result)) {
                $result[$guardId] = [];
            }

            $day = $start->format('m-d');
            if (!array_key_exists($day, $result[$guardId])) {
                $result[$guardId][$day] = array_fill(0, 60, 0);
            }

            $startMinutes = (int) $start->format('i');
            $endMinutes = (int) $interaction->date->format('i');

            foreach (range($startMinutes, $endMinutes) as $minute) {
                $result[$guardId][$day][$minute] = 1;
            }
            $result[$guardId][$day][$minute] = 0;

            break;
    }
}

foreach ($result as $guardId => $days) {
    $maxSleeps[$guardId] = [];
    foreach ($days as $day => $sleeps) {
        $maxSleeps[$guardId][] = array_sum($sleeps);
    }

    $maxSleeps[$guardId] = array_sum($maxSleeps[$guardId]);
}

arsort($maxSleeps);
$guardId = key($maxSleeps);
$nbSleeps = reset($maxSleeps);

echo "guard = $guardId - nbSleeps = $nbSleeps\n";

$max = array_fill(0,60, 0);
foreach ($result[$guardId] as $day => $sleeps) {
    foreach ($sleeps as $i => $sleep) {
        $max[$i]+=$sleep;
    }
}

arsort($max);
echo "minutes = " . key($max)."\n";

echo "result = ". key($max)*$guardId."\n";

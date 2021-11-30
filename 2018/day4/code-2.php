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
                $result[$guardId] = array_fill(0, 60, 0);
            }

            $startMinutes = (int) $start->format('i');
            $endMinutes = (int) $interaction->date->format('i');

            foreach (range($startMinutes, $endMinutes - 1) as $minute) {
                $result[$guardId][$minute]++;
            }

            break;
    }
}

$guard = null;
$minute = null;
$max = 0;
foreach ($result as $guardId => $sleeps) {
    arsort($sleeps);
    $minute = key($sleeps);
    if ($max < current($sleeps)) {
        $minute = key($sleeps);
        $max = current($sleeps);
        $guard = $guardId;
    }
}

echo "guard = $guard, minute = $minute\n";
echo $guard * $minute;

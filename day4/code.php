<?php

$lines = file('./input.txt');

// $lines = [
//     '[1518-11-01 00:00] Guard #10 begins shift',
//     '[1518-11-01 00:05] falls asleep',
//     '[1518-11-01 00:25] wakes up',
//     '[1518-11-01 00:30] falls asleep',
//     '[1518-11-01 00:55] wakes up',
//     '[1518-11-01 23:58] Guard #99 begins shift',
//     '[1518-11-02 00:40] falls asleep',
//     '[1518-11-02 00:50] wakes up',
//     '[1518-11-03 00:05] Guard #10 begins shift',
//     '[1518-11-03 00:24] falls asleep',
//     '[1518-11-03 00:29] wakes up',
//     '[1518-11-04 00:02] Guard #99 begins shift',
//     '[1518-11-04 00:36] falls asleep',
//     '[1518-11-04 00:46] wakes up',
//     '[1518-11-05 00:03] Guard #99 begins shift',
//     '[1518-11-05 00:45] falls asleep',
//     '[1518-11-05 00:55] wakes up',
// ];


class Interaction
{
    public const TYPE_START = 'start';
    public const TYPE_SLEEP = 'sleep';
    public const TYPE_WAKE_UP = 'wake-up';

    /** @var \DateTime */
    public $date;

    /** @var int */
    public $guardId;

    /** @var string */
    public $action;

    function __construct(string $line)
    {
        preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2})\] (.+)/', $line, $matches);

        $this->date = new \DateTime($matches[1]);
        $action = $matches[2];

        switch ($action) {
            case 'falls asleep':
                $this->action = self::TYPE_SLEEP;
                break;
            case 'wakes up':
                $this->action = self::TYPE_WAKE_UP;
                break;
            default:
                if (preg_match('/Guard #(\d+) begins shift/', $action, $matches)) {
                    $this->guardId = $matches[1];

                    $this->action = self::TYPE_START;
                }
                break;
        }
    }
}


$interations = [];

foreach ($lines as $line) {
    $interations[] = new Interaction($line);
}

usort($interations, function (Interaction $a, Interaction $b) {
    return $a->date <=> $b->date;
});

$results = [];

$guardId = null;
$start = null;
foreach ($interations as $interation) {
    switch ($interation->action) {
        case Interaction::TYPE_START:
            $guardId = $interation->guardId;
            break;
        case Interaction::TYPE_SLEEP:
            $start = $interation->date;
        case Interaction::TYPE_WAKE_UP:
            $duration = $start->diff($interation->date);

            if (!array_key_exists($start->format('Y-m-d'), $results)) {
                $results[$guardId][$start->format('Y-m-d')] = array_fill(0, 60, false)
            }
            $results[$guardId][$start->format('Y-m-d')] =;
    }
}

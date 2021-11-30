<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day7;

use Benji07\AdventOfCode\Shared\IntcodeComputer;

class Program
{
    /** @var Amplifier[] */
    private array $amplifiers;

    private bool $loopFeedBack;

    /**
     * @param int[] $memory
     */
    public function __construct(array $memory, bool $loopFeedBack = false)
    {
        $this->amplifiers = [
            new Amplifier(new IntcodeComputer($memory, $loopFeedBack, $loopFeedBack)),
            new Amplifier(new IntcodeComputer($memory, $loopFeedBack, $loopFeedBack)),
            new Amplifier(new IntcodeComputer($memory, $loopFeedBack, $loopFeedBack)),
            new Amplifier(new IntcodeComputer($memory, $loopFeedBack, $loopFeedBack)),
            new Amplifier(new IntcodeComputer($memory, $loopFeedBack, $loopFeedBack)),
        ];
        $this->loopFeedBack = $loopFeedBack;
    }

    /**
     * @param int[] $phaseSequence
     */
    public function getThrusterSignal(array $phaseSequence): int
    {
        $previous = $output = 0;
        try {
            for ($j = 0; $j < 10; ++$j) {
                foreach ($this->amplifiers as $i => $amplifier) {
                    //var_dump('amplifier-'.$i);
                    $defaultInput = array_shift($phaseSequence);
                    $input = [];

                    if ($defaultInput !== null) {
                        $input[] = $defaultInput;
                    }

                    $input[] = $output;
                    //var_dump('input = ' . implode(', ', $input));
                    $previous = $output = $amplifier->run($input);
                    //var_dump('output = ' . $output);
                }

                if ($this->loopFeedBack === false) {
                    return (int) $output;
                }
            }

            return (int) $output;
        } catch (IntcodeComputer\EndOfProgramException $exception) {
            //var_dump($exception, $exception->getOutput());
            return $previous;
        }
    }

    public function getMaxThrusterSignal(int $min = 0, int $max = 4): int
    {
        $maxSignal = 0;

        foreach ($this->getPossiblePhaseSequence($min, $max) as $phaseSequence) {
            $this->resetComputer();
            $maxSignal = max($maxSignal, $this->getThrusterSignal($phaseSequence));
        }

        return $maxSignal;
    }

    protected function getPossiblePhaseSequence(int $min, int $max): iterable
    {
        $phaseSequence = [];
        for ($i = $min; $i <= $max; ++$i) {
            $phaseSequence[0] = $i;
            for ($j = $min; $j <= $max; ++$j) {
                $phaseSequence[1] = $j;
                for ($k = $min; $k <= $max; ++$k) {
                    $phaseSequence[2] = $k;
                    for ($l = $min; $l <= $max; ++$l) {
                        $phaseSequence[3] = $l;
                        for ($m = $min; $m <= $max; ++$m) {
                            $phaseSequence[4] = $m;
                            if (count(array_unique($phaseSequence)) < count($this->amplifiers)) {
                                continue;
                            }

                            yield $phaseSequence;
                        }
                    }
                }
            }
        }

        return;
    }

    private function resetComputer()
    {
        foreach ($this->amplifiers as $amplifier) {
            $amplifier->reset();
        }
    }
}

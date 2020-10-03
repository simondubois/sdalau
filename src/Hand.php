<?php

namespace App;

use App\Dices\FateDice;
use App\Dices\SuccessDice;
use App\Exceptions\DiceExhaustedException;

class Hand
{
    /**
     * @var array<\App\Dices\Dice>
     */
    protected array $dices = [];

    public function __construct(int $successDices, bool $weary)
    {
        $this->dices[] = new FateDice();

        for ($count = 0; $count < $successDices; $count++) {
            $this->dices[] = new SuccessDice($weary);
        }
    }

    public function success(int $target): float
    {
        $successes = 0;
        $tries = 0;

        try {
            while (true) {
                if ($this->result() >= $target) {
                    ++$successes;
                }
                ++$tries;
            }
        } catch (DiceExhaustedException $exception) {
            //
        }

        return $successes / $tries;
    }

    public function result(): int
    {
        return $this->readDicesFromIndex(0);
    }

    protected function readDicesFromIndex(int $index): int
    {
        if ($index + 1 === count($this->dices)) {
            return $this->dices[$index]->readThenRoll();
        }

        try {
            return $this->dices[$index]->read() + $this->readDicesFromIndex($index + 1);
        } catch (DiceExhaustedException $exception) {
            return $this->dices[$index]->roll()->read() + $this->readDicesFromIndex($index + 1);
        }
    }
}

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

    public function __construct(int $successDices)
    {
        $this->dices[] = new FateDice();

        for ($count = 0; $count < $successDices; $count++) {
            $this->dices[] = new SuccessDice();
        }
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

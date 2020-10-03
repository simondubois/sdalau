<?php

namespace App\Dices;

use App\Exceptions\DiceExhaustedException;

abstract class Dice
{
    protected int $faceIndex = 0;

    /**
     * @return array<int>
     */
    abstract public function faces(): array;

    public function read(): int
    {
        if (array_key_exists($this->faceIndex, $this->faces())) {
            return $this->faces()[$this->faceIndex];
        };

        $this->faceIndex = 0;

        throw new DiceExhaustedException();
    }

    public function readThenRoll(): int
    {
        $result = $this->read();

        $this->roll();

        return $result;
    }

    public function roll(): Dice
    {
        ++$this->faceIndex;

        return $this;
    }
}

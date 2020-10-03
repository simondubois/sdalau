<?php

namespace App\Dices;

class SuccessDice extends Dice
{
    protected bool $weary = false;

    public function __construct(bool $weary)
    {
        $this->weary = $weary;
    }

    /**
     * @return array<int>
     */
    public function faces(): array
    {
        return [1, 2, 3, 4, 5, 6];
    }

    public function read(): int
    {
        $face = parent::read();

        if ($this->weary && $face <= 3) {
            return 0;
        }

        return $face;
    }
}

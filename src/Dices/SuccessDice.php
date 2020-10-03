<?php

namespace App\Dices;

class SuccessDice extends Dice
{
    /**
     * @return array<int>
     */
    public function faces(): array
    {
        return [1, 2, 3, 4, 5, 6];
    }
}

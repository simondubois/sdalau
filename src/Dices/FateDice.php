<?php

namespace App\Dices;

class FateDice extends Dice
{
    /**
     * @return array<int>
     */
    public function faces(): array
    {
        return [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 100];
    }
}

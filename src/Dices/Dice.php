<?php

namespace App\Dices;

abstract class Dice
{
    protected int $faceIndex = 0;

    /**
     * @return array<int>
     */
    abstract public function faces(): array;
}

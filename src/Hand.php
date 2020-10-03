<?php

namespace App;

use App\Dices\FateDice;
use App\Dices\SuccessDice;

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
}

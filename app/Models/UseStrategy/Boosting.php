<?php

namespace App\Models\UseStrategy;

class Boosting extends UseStrategy
{
    public function __construct(int $creatureId, int $energy)
    {
        parent::__construct($creatureId, $energy);
    }

    public function execute() : void
    {
        $this->CREATURE->boost($this->VALUE);
    }
}
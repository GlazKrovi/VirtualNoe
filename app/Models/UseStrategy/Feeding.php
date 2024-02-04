<?php

namespace App\Models\UseStrategy;

class Feeding extends UseStrategy
{
    public function __construct(int $creatureId, int $calories)
    {
        parent::__construct($creatureId, $calories);
    }

    public function execute() : void
    {
        $this->CREATURE->feed($this->VALUE);
    }
}
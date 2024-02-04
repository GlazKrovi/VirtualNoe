<?php

namespace App\Models\UseStrategy;

class Boosting extends UseStrategy
{
    public function __construct(int $energy)
    {
        parent::__construct($energy);
    }

    public function executeOn(int $creatureId): void
    {
        $this->retrieveTarget($creatureId)->boost($this->VALUE);
    }
}
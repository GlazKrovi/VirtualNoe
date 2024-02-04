<?php

namespace App\Models\UseStrategy;

class Feeding extends UseStrategy
{
    public function __construct(int $calories)
    {
        parent::__construct($calories);
    }

    public function executeOn(int $creatureId): void
    {
        $this->retrieveTarget($creatureId)->feed($this->VALUE);
    }
}
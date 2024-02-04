<?php

namespace App\Models\UseStrategy;

use App\Models\Creature;
use Illuminate\Testing\Exceptions\InvalidArgumentException;

abstract class UseStrategy
{
    protected Creature $CREATURE;
    protected int $VALUE;

    protected function __construct(int $creatureId, int $value)
    {
        $this->VALUE = $value;
        $this->CREATURE = Creature::find($creatureId);

        if ($this->CREATURE)
            throw new InvalidArgumentException("Invalid creatureId");
    }

    public abstract function execute(): void;
}

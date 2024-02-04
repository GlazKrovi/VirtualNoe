<?php

namespace App\Models\UseStrategy;

use App\Models\Creature;
use Illuminate\Testing\Exceptions\InvalidArgumentException;

abstract class UseStrategy
{
    protected int $VALUE;

    protected function __construct(int $value)
    {
        $this->VALUE = $value;
    }

    public abstract function executeOn(int $creatureId): void;

    protected function retrieveTarget(int $creatureId) : Creature
    {
        $creature = Creature::find($creatureId);

        if ($creature){
            throw new InvalidArgumentException("Invalid creatureId");
        }

        return $creature;
    }
}

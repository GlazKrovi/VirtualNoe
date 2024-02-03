<?php

namespace App\Models;

class Food extends Item implements IFood
{
    protected $fillable = [
        'name',
        'type',
        'price',
        'calories',
    ];

    public function calories() : int
    {
        return $this->attributes['calories'];
    }
}

<?php

namespace App\Models;

use App\Models\UseStrategy\Feeding;

class Food extends Item 
{
    protected $fillable = [
        'name',
        'type',
        'price',
        'calories',
    ];

    protected UseStrategy $usage = new Feeding($this->calories());

    public function calories() : int
    {
        return $this->attributes['calories'];
    }
}

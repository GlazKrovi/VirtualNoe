<?php

namespace App\Models;

use App\Models\UseStrategy\Boosting;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boost extends Item 
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
        'energy',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->usage = new Boosting($this->energy());
    }

    public function energy() : int
    {
        return $this->attributes['energy'];
    }
}

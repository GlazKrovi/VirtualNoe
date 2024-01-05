<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boost extends Item implements IBoost
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'type',
        'price',
        'energy',
    ];

    public function energy() : int
    {
        return $this->attributes['energy'];
    }

    public function use() : void // TODO
    {
        return;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boost extends Item implements IBoost
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'energy',
    ];

    public function energy() : int
    {
        return $this->attributes['energy'];
    }
}

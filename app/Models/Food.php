<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Food extends Item implements IFood
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'calories',
    ];

    public function calories() : int
    {
        return $this->attributes['calories'];
    }
}

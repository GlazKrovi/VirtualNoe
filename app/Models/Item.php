<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Item extends Model implements IItem
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
    ];

    public function name() : string
    {
        return $this->attributes['name'];
    }

    public function type() : string
    {
        return $this->attributes['type'];
    }

    public function price() : int
    {
        return $this->attributes['price'];
    }

    public abstract function use();
}

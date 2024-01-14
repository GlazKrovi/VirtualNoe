<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

abstract class Item extends Model implements IItem
{   
    public $timestamps = false;

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

    public abstract function use() : void;

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('quantity');   
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Item extends Model implements IItem
{   
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

    protected function users()
    {
        return $this->belongsToMany(User::class, 'user_item')->withPivot('quantity');
    }
}

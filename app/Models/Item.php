<?php

namespace App\Models;

use App\Models\UseStrategy\UseStrategy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

abstract class Item extends Model implements IItem
{   
    public $timestamps = false;
    protected UseStrategy $usage;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function id() : int
    {
        return $this->attributes['id'];
    }

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

    public function usage() : UseStrategy
    {
        return $this->usage;
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('quantity');   
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model implements IItem
{   
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'type',
        'price',
        'modificator',
    ];

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

    public function modificator(): int
    {
        return $this->modificator;
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('quantity');   
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model implements IFood
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

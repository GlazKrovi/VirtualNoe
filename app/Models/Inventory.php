<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
    ];

    public static function quantity(User $owner, Item $item) : int   
    {
        return Item::where('user_id', $owner->id())
            ->where('item_id', $item->id())
            ->first();
    }
}

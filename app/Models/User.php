<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Illuminate\Database\Eloquent\Collection;

class User extends Authenticatable implements IPlayer
{
    // DB
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // OWNS
    public static function default_money() : int 
    {
        return 50;
    }
    
    public function quantity(IItem $item) : int   
    {
        $qtyRow = $this->items()->where('item_id', $item->id)->first();
        return $qtyRow ? $qtyRow->pivot->quantity : 0;  // return 0 if unfound       
    }
   
    public function itemsOfType(IItem $type) : array
    {
        return Item::where('type', $type)->get()->toArray();
    }

    public function login() : string
    {
        return $this->attributes['login'];
    }

    public function password() : string
    {
        return $this->attributes['password'];
    }

    public function level() : int
    {
        return $this->attributes['level'];
    }

    public function money() : int
    {
        return $this->attributes['money'];
    }

    public function items() : Collection
    {
        $allItems = new Collection();
        $allItems->concat($this->foods());
        $allItems->concat($this->boost());
        return $allItems;
    }

    protected function foods() : Collection
    {
        return $this->belongsToMany(Food::class)->withPivot('quantity')->get();
    }

    protected function boosts() : Collection
    {
        return $this->belongsToMany(Boost::class)->withPivot('quantity')->get();
    }

    public function setLevel(int $level): void
    {
        $this->attributes['level'] = $level;
        $this->save();
    }

    public function setMoney(int $money): void
    {
        $this->attributes['money'] = $money;
        $this->save();
    }
}

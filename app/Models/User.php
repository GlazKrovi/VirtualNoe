<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
    
    public function quantityOf(IItem $item) : int   
    {
        return Inventory::quantity($this, $item);
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
}

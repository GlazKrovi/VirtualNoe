<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function items()
    {
        return $this->hasMany(Item::class);
    }

    
    public function quantityOf(IItem $item) : int   
    {
        return Item::findOrFail($item->name())->first();
    }

    /**
     * Exemple de méthode renvoyant une collection d'objets Item.
     *
     * @return Illuminate\Database\Eloquent\Collection|\App\Models\Item[]
     */
    public function itemsOfType(IItem $type) : Collection // TODO
    {
        return Item::where('type', $type)->get()->toArray();
    }
}

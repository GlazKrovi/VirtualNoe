<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\InventoryController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model implements IPlayer
{
    // DB
    use HasFactory;

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

    // COMMON
    public static function createWithItems(array $data)
    {
        $user = User::updateOrCreate($data);

        // Give the user some basic items
        $inventoryController = new InventoryController($user);
        $inventoryController->add($user, Item::where('name', 'Pet Food')->first(), 3);
        $inventoryController->add($user, Item::where('name', 'Vitamin')->first(), 2);
        
        return $user;
    }

    // OWNS    
    public function id(): int
    {
        return $this->attributes['id'];
    }

    public function name(): string
    {
        return $this->attributes['name'];
    }

    public function password(): string
    {
        return $this->attributes['password'];
    }

    public function email(): string
    {
        return $this->attributes['email'];
    }

    public function level(): int
    {
        return $this->attributes['level'];
    }

    public function money(): int
    {
        return $this->attributes['money'];
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity')->wherePivot('quantity', '>', 0);
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

    public function creatures(): HasMany
    {
        return $this->hasMany(Creature::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\InventoryController;

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

    // COMMON
    public static function createWithItems(array $data)
    {
        $user = User::create($data);

        // Give the user some basic items
        $inventoryController = new InventoryController($user);

        $petFood = Food::where('name', 'Pet Food')->first();
        if ($petFood) {
            Log::debug('Pet Food retrieved successfully: ' . $petFood->name);
            $inventoryController->add($petFood, 3);
        } else {
            Log::debug('Pet Food not found!');
        }

        $vitamin = Boost::where('name', 'Vitamin')->first();
        if ($vitamin) {
            $inventoryController->add($vitamin, 1);
        } else {
            Log::debug('Vitamin not found!');
        }

        return $user;
    }

    // OWNS    
    public function quantity(IItem $item) : int   
    {
        $qtyRow = $this->items()->where('item_id', $item->id)->first();
        return $qtyRow ? $qtyRow->pivot->quantity : 0;  // return 0 if unfound       
    }
   
    public function itemsOfType(IItem $type) : array
    {
        return Item::where('type', $type)->get()->toArray();
    }

    public function name() : string
    {
        return $this->attributes['name'];
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
        $allItems->concat($this->boosts());
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

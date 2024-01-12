<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\InventoryController;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
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
        $user = User::create($data);

        // Give the user some basic items
        $inventoryController = new InventoryController($user);

        $petFood = Food::where('name', 'Pet Food')->first();
        if ($petFood) {
            Log::debug('Pet Food retrieved successfully: ' . $petFood->name);
            $inventoryController->add($user, $petFood, 3);
        } else {
            Log::debug('Pet Food not found!');
        }

        $vitamin = Boost::where('name', 'Vitamin')->first();
        if ($vitamin) {
            $inventoryController->add($user, $vitamin, 1);
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

    public function id() : int
    {
        return $this->attributes['id'];
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

    public function items() 
    {
        $all = new Collection();
        foreach ($this->boosts() as $boost)
        {
            $all->add($boost);
        }
        foreach ($this->foods() as $food)
        {
            $all->add($food);
        }
        return $all;
    }

    protected function foods() 
    {
        return $this->belongsToMany(Food::class)->withPivot('quantity')->get();
    }

    protected function boosts() 
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

    public function creature() : HasMany 
    {
        return $this->hasMany(Creature::class);
    }
}

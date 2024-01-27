<?php

namespace App\Http\Controllers;

use App\Models\Boost;
use App\Models\Food;
use InvalidArgumentException;
use Exception;
use App\Models\Item;
use App\Models\IPlayer;
use Illuminate\Support\Facades\Session;

class InventoryController extends Controller
{
    public function show()
    {
        $player = session('user');
        // open view
        return view('inventory')->with('player', $player)->with('userItems', $player->items());
    }

    public function use(int $creatureId, int $itemId, string $type)
    {
        $creatureController = new CreatureController();
        
        if (strtolower($type) == "food")
        {
            $item = Food::find($itemId);
            $creatureController->feed($creatureId, $item->calories());
        }

        else if (strtolower($type) == "boost")
        {
            $item = Boost::find($itemId);
            $creatureController->boost($creatureId, $item->energy());
        }

        else throw new Exception('Invalid item type');

        // back to inventory
        $player = session('user');
        return view('inventory')->with('player', $player)->with('userItems', $player->items())->with('message', 'You just used "' . $item->name() . '"!');
    }

    public function add(IPlayer $player, Item $item, int $quantity)
    {
        $this->modifyInventory($player, $item, $quantity, true);
    }

    public function remove(IPlayer $player, Item $item, int $quantity)
    {
        $this->modifyInventory($player, $item, $quantity, false);
    }

    private function modifyInventory(IPlayer $player, Item $item, int $quantity, bool $add)
    {
        if ($quantity < 0) {
            throw new InvalidArgumentException("Try to add a negative value. Use 'remove' instead.");
        }
        
        // Get the pivot model instance
        $pivot = $item->users()->where('user_id', $player->id)->first();
    
        // Calculate new quantity based on add/remove action
        if ($pivot) 
        {
            $newQuantity = $add ? ($pivot->quantity + $quantity) : ($pivot->quantity - $quantity);
        }   
        // no entry yet? 
        else $newQuantity = $quantity;
    
        // Check if enough quantity is available for removal
        if (!$add && $newQuantity < 0) {
            throw new Exception("Not enough quantity of specified item.");
        }
    
        // Update or create the pivot record
        if ($pivot) {
            $pivot->update(['quantity' => $newQuantity]);
        } else {
            $item->users()->attach($player->id, ['quantity' => $newQuantity]);
        }
    }
}
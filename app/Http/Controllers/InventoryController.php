<?php

namespace App\Http\Controllers;

use InvalidArgumentException;
use Exception;
use App\Models\Item;
use App\Models\IPlayer;

class InventoryController extends Controller
{
    protected IPlayer $player;

    public function __construct(IPlayer $player = null) {
        // try to get currently connected player if unspecified
        if ($player == null)
        {
            $player = PlayerController::player();
        }
        $this->player = $player;
    }

    public function show()
    {
        $userItems = $this->player->items();

        // open view
        return view('inventory')->with('player', $this->player)->with('userItems', $userItems);
    }

    public function add(Item $item, int $quantity)
    {
        $this->modifyInventory($this->player, $item, $quantity, true);
    }

    public function remove(Item $item, int $quantity)
    {
        $this->modifyInventory($this->player, $item, $quantity, false);
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
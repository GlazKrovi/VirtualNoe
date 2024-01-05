<?php

namespace App\Http\Controllers;

use InvalidArgumentException;
use Exception;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Food;
use App\Models\Boost;

class InventoryController extends Controller
{
    public function add(Request $request)
    {
        $item = $request->input('item');
        $quantity = $request->input('quantity');
        $player = PlayerController::player();

        if ($quantity < 0) throw new InvalidArgumentException("Try to add negative value. Use remove instead");
        
        // wich type?
        if ($item instanceof Food)
        {
            $collection = $this->foods();
        }        
        else if ($item instanceof Boost)
        {
            $collection = $this->boosts();
        }
        else
        {
            throw new InvalidArgumentException("Invalid item type");
        }

        // get actual qty
        $actQty = $collection->where('item_id', $item->id)
            ->where('user_id', $player->id)
            ->value('quantity') ?? 0;
        $newQuantity = $actQty + $quantity;

        // update db
        $collection->syncWithoutDetaching([$item->id => ['quantity' => $newQuantity]]);
    }

    public function remove(Request $request)
    {
        $item = $request->input('item');
        $quantity = $request->input('quantity');
        $player = PlayerController::player();

        if ($quantity < 0) throw new InvalidArgumentException("Try to add negative value. Use remove instead");
        
        // wich type?
        if ($item instanceof Food)
        {
            $collection = $this->foods();
        }        
        else if ($item instanceof Boost)
        {
            $collection = $this->boosts();
        }
        else
        {
            throw new InvalidArgumentException("Invalid item type");
        }

        // get actual qty
        $actQty = $collection->where('item_id', $item->id)
            ->where('user_id', $player->id)
            ->value('quantity') ?? 0;
        $newQuantity = $actQty - $quantity;

        // have enough?
        if ($newQuantity < 0) throw new Exception("Not enough quantity of specified item.");     

        // update db
        $collection->syncWithoutDetaching([$item->id => ['quantity' => $newQuantity]]);
    }
}

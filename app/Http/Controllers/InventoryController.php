<?php

namespace App\Http\Controllers;

use App\Models\Boost;
use App\Models\Food;
use Exception;
use App\Models\IItem;
use App\Models\IPlayer;

class InventoryController extends Controller
{
    public function show(string $message = "")
    {
        $player = session('user');
        $userItems = $player->items();
        $creature = $player->creatures()->first();

        return view('inventory', [
            'player' => $player,
            'userItems' => $userItems,
            'creature' => $creature,
            'message' => $message,
        ]);
    }


    public function use(int $creatureId, int $itemId, string $type)
    {
        $creatureController = new CreatureController();

        if (strtolower($type) == "food") {
            $item = Food::find($itemId);
            $creatureController->feed($creatureId, $item->calories());
        } elseif (strtolower($type) == "boost") {
            $item = Boost::find($itemId);
            $creatureController->boost($creatureId, $item->energy());
        } else {
            throw new Exception('Invalid item type');
        }

        // Remove from inventory
        $this->remove(session('user'), $item, 1);

        // Redirect back to inventory
        return redirect()->route('inventory_show')->with('message', 'You just used "' . $item->name() . '"!');
    }

    public function quantityOf(IPlayer $player, IItem $item): int
    {
        $pivot = $item->users()->where('user_id', $player->id)->first();
        return $pivot ? $pivot->pivot->quantity : 0;
    }

    public function add(IPlayer $player, IItem $item, int $quantity)
    {
        // Retrieve the pivot model for this item and user
        $pivot = $item->users()->where('user_id', $player->id)->first();

        // Calculate the new quantity
        $newQuantity = $pivot ? ($pivot->pivot->quantity + $quantity) : $quantity;

        // Update or create the pivot record
        if ($pivot) {
            $pivot->update(['quantity' => $newQuantity]);
        } else {
            $item->users()->attach($player->id, ['quantity' => $newQuantity]);
        }
    }

    public function remove(IPlayer $player, IItem $item, int $quantity)
    {
        // Retrieve the pivot model for this item and user
        $pivot = $item->users()->where('user_id', $player->id)->first();

        // Calculate the new quantity
        $newQuantity = $pivot ? ($pivot->pivot->quantity - $quantity) : 0;

        // Check if the new quantity is valid
        if ($newQuantity >= 0) {
            // Update or create the pivot record
            if ($pivot) {
                // Update the pivot quantity directly
                $item->users()->updateExistingPivot($player->id, ['quantity' => $newQuantity]);
            } else {
                // Attach the item with the new quantity
                $item->users()->attach($player->id, ['quantity' => $newQuantity]);
            }
        } else {
            throw new Exception("Not enough quantity of specified item.");
        }
    }
}

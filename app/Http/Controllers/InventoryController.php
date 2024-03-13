<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use Exception;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    public function show(string $message = "")
    {
        $player = session('user');
        $userItems = $player->items()->get();
        $creature = $player->creatures()->first();

        return view('inventory', [
            'player' => $player,
            'userItems' => $userItems,
            'creature' => $creature,
            'message' => $message,
        ]);
    }

    public function use(User $owner, Creature $creature, Item $item)
    {
        $modificator = $item->modificator();

        switch (strtolower($item->type())) {
            case 'food':
                $creature->feed($modificator);
                break;
            case 'boost':
                $creature->boost($modificator);
                break;
            default:
                // Handle other item types if needed
                break;
        }

        // Remove used item from the player's inventory
        $this->remove($owner, $item, 1);

        // Redirect back to the inventory page with a success message
        return redirect()->route('inventory_show')->with('message', 'You just used "' . $item->name() . '"!');
    }

    public function quantityOf(User $player, Item $item): int
    {
        $pivot = $item->users()->where('user_id', $player->id)->first();
        return $pivot ? $pivot->pivot->quantity : 0;
    }

    public function add(User $player, Item $item, int $quantity)
    {
        // Retrieve the pivot model for this item and user
        $pivot = $item->users()->where('user_id', $player->id)->first();

        // Calculate the new quantity
        $newQuantity = $pivot ? ($pivot->pivot->quantity + $quantity) : $quantity;

        // Update or create the pivot record
        $item->users()->syncWithoutDetaching([$player->id => ['quantity' => $newQuantity]]);
    }

    public function remove(User $player, Item $item, int $quantity)
    {
        // Retrieve the pivot model for this item and user
        $pivot = $item->users()->where('user_id', $player->id)->first();

        // Check if the item exists in the player's inventory
        if ($pivot) {
            // Calculate the new quantity
            $newQuantity = max(0, $pivot->pivot->quantity - $quantity);

            // Update the pivot record
            if ($newQuantity > 0) {
                $item->users()->updateExistingPivot($player->id, ['quantity' => $newQuantity]);
            } else {
                // If the quantity becomes zero, remove the item from the player's inventory
                $item->users()->detach($player->id);
            }
        } else {
            throw new Exception("The specified item is not in the player's inventory.");
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ShopController extends Controller
{
    private $inventoryController;

    public function __construct()
    {
        $this->inventoryController = new InventoryController();
    }

    public function show()
    {
        $player = session('user');
        $available_items = Item::all();
        $message = session('message') ?? "";

        return view('shop', [
            'player' => $player,
            'available_items' => $available_items,
            'message' => $message,
        ]);
    }

    public function buy(int $itemId)
    {
        $player = session('user');
        $item = Item::find($itemId);

        if ($item && $player) {
            // have enough money?
            if ($player->money() >= $item->price()) {
                $this->inventoryController->add($player, $item, 1);
                $player->lose($item->price());
            } else {
                return redirect()->route('shop_show')->with('message', 'You do not have enough money for this!');
            }
        }
        // return to shop
        return redirect()->route('shop_show');
    }
}

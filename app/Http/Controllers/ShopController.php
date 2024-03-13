<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

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
        $player = session()->get('player');
        $item = Item::find($itemId);

        if ($item && $player) {
            // have enough money?
            if ($player->money() >= $item->price()) {
                $this->inventoryController->add($player, $item, 1);
            } else {
                session()->put('message', 'You do not have enough money for this!');
            }
        }

        // return to shop
        return $this->show();
    }
}

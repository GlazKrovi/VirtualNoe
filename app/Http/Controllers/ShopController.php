<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show(){
        $player = session('user');
        $available_items = Item::all();

        return view('shop', [
            'player' => $player,
            'available_items' => $available_items,
        ]);
    }
}

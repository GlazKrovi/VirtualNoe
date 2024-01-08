<?php

namespace App\Http\Controllers;

use App\Models\IPlayer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller   
{
    public function levelUp(Request $request) : void
    {
        $player = session('user');
        $amount = $request->input('experience');
        $actualQty = $player->level();
        
        // add amount to player
        $player->setLevel($amount + $actualQty);        
    }

    public function earn(Request $request) : void
    {
        $player = session('user');
        $amount = $request->input('amount');

        // security
        if ($amount < 0) throw new Exception("Try to add negative amount of money. Use remove instead.");

        $actualQty = $player->money();

        // add amount to player
        $player->setMoney($actualQty + $amount);
    }

    public function lose(Request $request) : void
    {
        $player = session('user');
        $amount = $request->input('amount');

        // security
        if ($amount < 0) throw new Exception("Try to remove negative amount of money. Use add instead.");

        $actualQty = $player->money();

        // remove amount to player
        $player->setMoney($actualQty - $amount);
    }
}

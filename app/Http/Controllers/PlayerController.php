<?php

namespace App\Http\Controllers;

use App\Models\IPlayer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller   
{
    /**
     * @return The player currently connected in session
     */
    public static function player() : IPlayer
    {
        $player = Auth::user();         // equivalent to session()->input('user') but when Auth is used!
        if($player == null) throw new Exception("No player currently connected");
        else if ($player instanceof IPlayer) return $player; 
        else throw new Exception("The user doesn't implements IPlayer");
    }

    public function levelUp(Request $request) : void
    {
        $player = PlayerController::player();
        $amount = $request->input('experience');
        $actualQty = $player->level();
        
        // add amount to player
        $player->setLevel($amount + $actualQty);        
    }

    public function earn(Request $request) : void
    {
        $player = PlayerController::player();
        $amount = $request->input('amount');

        // security
        if ($amount < 0) throw new Exception("Try to add negative amount of money. Use remove instead.");

        $actualQty = $player->money();

        // add amount to player
        $player->setMoney($actualQty + $amount);
    }

    public function lose(Request $request) : void
    {
        $player = PlayerController::player();
        $amount = $request->input('amount');

        // security
        if ($amount < 0) throw new Exception("Try to remove negative amount of money. Use add instead.");

        $actualQty = $player->money();

        // remove amount to player
        $player->setMoney($actualQty - $amount);
    }
}

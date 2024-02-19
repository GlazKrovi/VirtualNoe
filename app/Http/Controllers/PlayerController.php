<?php

namespace App\Http\Controllers;

use App\Models\IPlayer;
use Exception;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function levelUp(Request $request): void
    {
        $player = session('user');
        $amount = $request->input('experience');
        $actualQty = $player->level();

        // add amount to player
        $player->setLevel($amount + $actualQty);
    }

    public function earnMoney(IPlayer $player, int $amount): void
    {
        // security
        if ($amount < 0)
            throw new Exception("Try to add negative amount of money. Use remove instead.");

        // do it
        $player->earn($amount);

        // refresh
        (new ClockController())->refreshHunger($player->creatures()->first());
    }

    public function loseMoney(IPlayer $player, int $amount): void
    {
        // security
        if ($amount < 0) 
            throw new Exception("Try to remove negative amount of money. Use add instead.");

        // do it
        $player->lose($amount);

        // refresh
        (new ClockController())->refreshHunger($player->creatures()->first());
    }
}

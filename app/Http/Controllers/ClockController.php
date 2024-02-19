<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use Carbon\Carbon;

class ClockController extends Controller
{
    public function refresh(int $creatureId)
    {
        $creature = Creature::find($creatureId);
        $currentTime = Carbon::now();
        $lastUpdate = Carbon::parse($creature->updated_at);
        $differenceInMinutes = $currentTime->diffInMinutes($lastUpdate);
        if ($differenceInMinutes >= 5) {
            if ($creature->hunger() <= 0) {
                $creature->makeHungry(10);
            } else {
                $creature->hurt(10);
            }
        }
    }
}

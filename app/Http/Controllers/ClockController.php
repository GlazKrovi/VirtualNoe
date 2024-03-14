<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use Carbon\Carbon;

class ClockController extends Controller
{
    private $REFRESH_COOLDOWN = 2;

    /**
     * Every 2 minutes, make specified creature hungry, or hurt her if hunger level is 0.
     *
     * @param integer $creatureId
     * @return void
     */
    public function refresh(int $creatureId)
    {
        $creature = Creature::find($creatureId);
        $currentTime = Carbon::now();
        $lastUpdate = Carbon::parse($creature->updated_at);
        $differenceInMinutes = $currentTime->diffInMinutes($lastUpdate);
        if ($differenceInMinutes >= $this->REFRESH_COOLDOWN) {
            if ($creature->hunger() <= 0) {
                $creature->makeHungry(10);
            } else {
                $creature->hurt(10);
            }
        }
    }

    /**
     * Make specified creature hungry, or hurt her if hunger level is 0.
     * Same as refresh() but without cooldown.
     *
     * @param integer $creatureId
     * @return void
     */
    public function refreshFast(int $creatureId)
    {
        $creature = Creature::find($creatureId);
        if ($creature->hunger() > 0) {
            $creature->makeHungry(10);
        } else {
            $creature->hurt(10);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ClockController extends Controller
{
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

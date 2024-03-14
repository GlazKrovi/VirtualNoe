<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use Illuminate\Support\Facades\Log;

class ClockController extends Controller
{
    /**
     * Refreshes the state of the creature if the last update was more than 5 minutes ago.
     *
     * @param  int  $creatureId The ID of the creature to refresh.
     * @return void
     */
    public function refresh(int $creatureId)
    {
        $creature = Creature::find($creatureId);
        if (!$creature) return;

        // Make it hungry
        if ($creature->hunger() > 0) {
            $creature->makeHungry(10);
        } else {
            $creature->hurt(10);
        }

        Log::debug("refresh called");

        // Update the timestamp of the last update
        $creature->touch();
    }
}

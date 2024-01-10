<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use App\Models\Food;
use App\Models\ICreature;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Collection
    {
        return Creature::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        return redirect()->route('view_creature_create'); // TODO - give an eggs texture path (factory or something)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newCreature = $request->input('creature');
        if ($newCreature instanceof Creature)
        {
            $newCreature->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Creature $creature)
    {
        return redirect()->route('view_creature', ['creature', $creature]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Creature $creature)
    {
        return;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Creature $creature)
    {
        return;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Creature $creature)
    {
        $creature->delete();
    }

    public function feed(Request $request)
    {

        // securities 
        
        /*
            $item = $request->input('food');
            $creature = $request->input('creature');

            if($creature instanceof ICreature && $item ins)
        */

        // $this->feedCreature($creature, $item);
    }

    private function feedCreature(Creature $creature, Food $food)
    {
        $creature->hunger += $food->calories();
        if ($creature->hunger > $creature->MAX_HUNGER)
        {
            $creature->hunger =$creature->MAX_HUNGER;
        }
        $creature->save();             
    }


    public function heal()
    {
        // param = request
        // drug : IDrug
        // subfunction healCreature(Creature $creature, IDrug $drug)
    }

    public function boost()
    {
        // param = request
        // boost : IBoost
        // subfunction boostCreature(Creature $creature, Boost $boost)
    }
}

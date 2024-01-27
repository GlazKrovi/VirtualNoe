<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use App\Models\ICreature;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Exceptions\Exception;

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
        if ($creature == null) throw new Exception('null');
        return view('seecreature', ['creature' => $creature]);
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

    public function feed(int $creatureId, int $calories)
    {
        $creature = Creature::find($creatureId);
        $creature->setHunger($creature->hunger + $calories);
    }


    public function boost(int $creatureId, int $energy)
    {
        $creature = Creature::find($creatureId);
        $creature->setStamina($creature->stamina + $energy);
    }

    public function levelUp(int $creatureId, int $exp)
    {
        $creature = Creature::find($creatureId);
        $creature->setLevel($creature->level + $exp);
    }  
}

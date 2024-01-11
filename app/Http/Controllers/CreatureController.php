<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use App\Models\IBoost;
use App\Models\ICreature;
use App\Models\IFood;
use Carbon\Exceptions\InvalidCastException;
use Exception;
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
        if ($request->has('food')) {
            $item = $request->input('food');
        } else {
            throw new Exception('Variable not found');
        }
        
        if ($request->has('creature')) {
            $creature = $request->input('creature');
        } else {
            throw new Exception('Variable not found');
        }

        if(!$creature instanceof ICreature && !$item instanceof IFood)
        {
            throw new InvalidCastException();
        }
        
        $this->feedCreature($creature, $item);
    }

    private function feedCreature(Creature $creature, IFood $food)
    {
        $creature->hunger += $food->calories();
        if ($creature->hunger > $creature->MAX_HUNGER)
        {
            $creature->hunger =$creature->MAX_HUNGER;
        }
        $creature->save();             
    }

    public function boost(Request $request)
    {
        // securities 
        if ($request->has('boost')) {
            $item = $request->input('boost');
        } else {
            throw new Exception('Variable not found');
        }
        
        if ($request->has('creature')) {
            $creature = $request->input('creature');
        } else {
            throw new Exception('Variable not found');
        }

        if(!$creature instanceof ICreature && !$item instanceof IBoost)
        {
            throw new InvalidCastException();
        }
        
        $this->boostCreature($creature, $item);
    }

    private function boostCreature(Creature $creature, IBoost $boost)
    {
        $creature->stamina += $boost->energy();
        if ($creature->stamina > $creature->MAX_STAMINA)
        {
            $creature->stamina =$creature->MAX_STAMINA;
        }
        $creature->save();  
    }

    public function levelUp(Request $request)
    {
        // securities 
        if ($request->has('exp')) {
            $exp = $request->input('exp');
        } else {
            throw new Exception('Variable not found');
        }
        
        if ($request->has('creature')) {
            $creature = $request->input('creature');
        } else {
            throw new Exception('Variable not found');
        }

        if(!$creature instanceof ICreature)
        {
            throw new InvalidCastException();
        }

        $this->levelUpCreature($creature, $exp);
    }

    private function levelUpCreature(Creature $creature, int $exp)
    {
        $creature->level += $exp;
        if ($creature->level > $creature->MAX_LEVEL)
        {
            $creature->level =$creature->MAX_LEVEL;
        }
        $creature->save();  
    }


    /* 
    public function heal(Creature $creature, IDrug $drug)
    {
        // param = request
        // drug : IDrug
        // subfunction healCreature(Creature $creature, IDrug $drug)
        $creature->hunger += $drug->healing();
        if ($creature->hunger > $creature->MAX_HUNGER)
        {
            $creature->hunger =$creature->MAX_HUNGER;
        }
        $creature->save(); 
    }
    */

   
}

<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use App\Exceptions\Exception;

class CreatureController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('view_creature_create'); // TODO - give an eggs texture path (factory or something)
    }

    /**
     * Display the specified resource.
     */
    public function show(Creature $creature)
    {
        if ($creature == null) throw new Exception('null');
        return view('seecreature', ['creature' => $creature]);
    }
}

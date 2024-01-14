@extends('layouts.mainLayout')

@yield('title', "Creature's house")

@section('content')
    <div>
        <h1> Your creature{{ $creature ? " (" . $creature->id() . ")" : "" }}:</h1>
        <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->

        @isset($creature)
            <div class="creature-info">
                <h2> {{ $creature->name() }} </h2>
                <p> Level: {{ $creature->level() }} </p>
                <p> Life: {{ $creature->life() }} </p>
                <p> Hunger: {{ $creature->hunger() }} </p>
                <p> Stamina: {{ $creature->stamina() }} </p>
            </div>  
        @endisset
    
        @includeIf('shared.creature', ['creature' => $creature])
    
        <a href="{{ route('inventory_show') }}">Inventory</a>
    
    </div>
@endsection


    
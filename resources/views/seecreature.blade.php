@extends('layouts.mainLayout')

@section('title', "Creature's house")

@section('content')
    <div>
        <h1> Your creature{{ $creature ? " (" . $creature->id() . ")" : "" }}:</h1>
        <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->

        @isset($creature)
            <div class="creature-info">
                <h2> {{ $creature->name() }} </h2>
                <div class="creature-block">
                    <ul>
                        <li> Level: {{ $creature->level() }} </li>
                        <li> Life: {{ $creature->life() }} </li>
                        <li> Hunger: {{ $creature->hunger() }} </li>
                        <li> Stamina: {{ $creature->stamina() }} </li>
                    </ul>
                @includeIf('shared.creature', ['creature' => $creature]) 
                </div>
            </div>  
        @endisset
    </div>
@endsection

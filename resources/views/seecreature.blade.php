@extends('layouts.mainLayout')

@yield('title', "Creature's house")

@section('content')
    <div>
        <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    
        @includeIf('shared.creature', ['creature' => $creature])
    
        <a href="{{ route('inventory_show') }}">Inventory</a>
    
    </div>
@endsection


    
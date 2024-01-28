@extends('layouts.mainLayout')

@section('title', "Creature's house")

@section('content')
    <div>
        <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->

        @isset($creature)
            <div id="creature-block" class="block">
                @includeIf('shared.creature_resume', ['creature' => $creature])
                @includeIf('shared.creature', ['creature' => $creature])
            </div>
        @endisset
    </div>
@endsection

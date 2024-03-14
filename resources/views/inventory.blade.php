@extends('layouts.mainLayout')

@section('title','HOME')

<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
@section('content')
    <div>
        <h1> Inventory of "{{ $player->name() }}": </h1>

        @includeIf('shared.creature_resume', ['creature' => $creature]) 

        @foreach ($userItems as $item)
            <div class="block" id="item-info"> 
                @include('shared.item', ['item' => $item])

                <form action="{{ route('inventory_use', ['owner' => $player, 'creature' => $player->creatures()->first(), 'item' => $item]) }}" method="POST">
                    @csrf
                    <button type="submit">Use</button>
                </form>
            </div>
        @endforeach

        @if ($message)
            <div class="message">
                <p> {{ $message }} </p>
            </div>
        @endif
    </div>
@endsection

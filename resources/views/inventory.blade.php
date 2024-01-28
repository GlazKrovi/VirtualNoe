@extends('layouts.mainLayout')

@section('title','HOME')

<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
@section('content')
    <div>
        <h1> Inventory of "{{ $player->name() }}": </h1>

        @foreach ($userItems as $item)
            <div class="item-info"> 
                <p> Name: {{ $item->name() }} </p>
                <p> Type: {{ $item->type() }} </p>
                <p> Price: {{ $item->price() }} </p>
                <p> Quantity: {{ $item->pivot->quantity }} </p>

                <form action="{{ route('inventory_use', ['creatureId' => $player->creatures()->first(), 'itemId' => $item->id(), 'type' => $item->type()]) }}" method="POST">
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

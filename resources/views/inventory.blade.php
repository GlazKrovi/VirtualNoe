@extends('layouts.mainLayout')

@section('title','HOME')

<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
@section('content')
    <div>
        <h1> Inventory of "{{ $player->name() }}": </h1>

        <p class="how-many-items"> You have currently {{ $userItems->count() }} items </p> 

        @foreach ($userItems as $item)
            <div class="item-info"> 
                <p> Name: {{ $item->name() }} </p>
                <p> Type: {{ $item->type() }} </p>
                <p> Price: {{ $item->price() }} </p>

                <form action="{{ route('inventory_use', ['creatureId' => $player->creatures()->first(), 'itemId' => $item->id(), 'type' => $item->type()]) }}" method="POST">
                    @csrf
                    <button type="submit">Use</button>
                </form>
            </div>
        @endforeach

        @isset($message)
            <div class="message">
                <p> {{ $message }} </p>
            </div>
        @endisset
    </div>
@endsection

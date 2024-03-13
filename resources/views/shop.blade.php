@extends('layouts.mainLayout')

@section('title', 'SHOP')

<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
@section('content')
    <div>
        @includeIf('shared.wallet', ['money' => $player->money()])
        @foreach ($available_items as $item)
            <div class="block" id="item-info">
                <h3>{{ $item->name }}</h3>
                <p>Type: {{ $item->type }}</p>
                <p>Price: {{ $item->price }}</p>
                <p>Modifier: {{ $item->modificator }}</p>

                <form action="{{ route('shop_buy', ['itemId' => $item->id]) }}" method="POST">
                    @csrf
                    <button type="submit">Buy</button>
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

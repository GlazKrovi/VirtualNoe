@extends('layouts.mainLayout')

@section('title', 'SHOP')

<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
@section('content')
    <div>
        @foreach ($available_items as $item)
            <div class="block" id="item-info">
                <h3>{{ $item->name }}</h3>
                <p>Type: {{ $item->type }}</p>
                <p>Price: {{ $item->price }}</p>
                <p>Modifier: {{ $item->modificator }}</p>

                <form action="{{ route('shop_buy', ['item' => $item->id]) }}" method="POST">
                    @csrf
                    <button type="submit">Buy</button>
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

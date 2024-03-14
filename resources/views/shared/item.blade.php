@isset($item)
    <p> Name: {{ $item->name() }} </p>
    <p> Type: {{ $item->type() }} </p>
    <p> Price: {{ $item->price() }} </p>
    <p> Quantity: {{ $item->pivot->quantity }} </p>
@endisset

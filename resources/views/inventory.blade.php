<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
<div>
    <h1> Inventory of {{ $player->name() }} : </h1>

    <h3> You have currently {{ $userItems->count(); }} items </h3> 

    @foreach ($userItems as $item)
        <section class="player_item"> 
            <p> name {{ $item->name() }} </p>
            <p> type {{ $item->type() }} </p>
            <p> price {{ $item->price() }} </p>
        </section>
    @endforeach
</div>

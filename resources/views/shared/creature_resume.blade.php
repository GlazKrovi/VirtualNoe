@isset($creature)
    <div class="creature-resume">
        <h2> {{ $creature->name() }} </h2>
        <ul>
            <li> Level: {{ $creature->level() }} </li>
            <li> Life: {{ $creature->life() }} </li>
            <li> Hunger: {{ $creature->hunger() }} </li>
            <li> Stamina: {{ $creature->stamina() }} </li>
        </ul>
    </div>
@endisset

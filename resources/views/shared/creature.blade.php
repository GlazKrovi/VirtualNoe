<div class="creature-texture">
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
    @isset($creature)
        <img src="{{ $creature->texture() }}" alt="Your creature">
        <p>{{ $creature->texture() }}</p>
    @endisset

    @empty($creature)
        <p> creature's skin not found </p>
    @endempty
</div>

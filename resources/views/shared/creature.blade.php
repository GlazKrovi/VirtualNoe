<div class="creature-texture">
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
    @isset($creature)
        <img id="creature-texture" src="{{ $creature->texture() }}" alt="Your creature"> 
    @endisset
</div>

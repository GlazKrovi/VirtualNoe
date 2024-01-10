<div class="creature-texture">
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
    @if ($texturePath)
        <img src="{{ asset($texturePath) }}" alt="Your creature">
    @else
        <p> creature's skin not found </p>
    @endif
</div>

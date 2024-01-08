<?php session_start(); ?>

<div>
    <!-- Bloc d'affichage des messages -->
	@if (session('message'))
		<section>
			<p>{{ session('message') }}</p>
		</section>
	@else
		<section>
			<p>-No error message-</p>
		</section>
	@endif
	<a href={{ to_route('view_home') }}> Destroy session! </a> 
	<br>
    <a href="/"> Exit </a>
</div>
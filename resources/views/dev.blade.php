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
	<a href={{ to_route('user_signout') }}> Destroy session! </a> <p> (= disconnect) </p> 
	<br>
    <a href="/"> Exit </a>
</div>
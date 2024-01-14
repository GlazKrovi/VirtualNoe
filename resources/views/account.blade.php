@extends('layouts.mainLayout')

@section('title','Account')

@section('content')
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
	<h1> My account </h1>
	<p>
		Hello {{ session('user')->name() }} !<br>
		Welcome to your account.
	</p>
	<ul>
		<li><a href="{{ route('view_formpassword') }}">Change password</a></li>
		<li><a href="{{ route('user_deleteuser') }}">Delete my account</a></li>
	</ul>
	<p><a href="signout">Sign out</a></p>

	<?php 
		use App\Models\User;
		use App\Models\IPlayer;

		$player = session('user');

	?>

@endsection

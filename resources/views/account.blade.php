@extends('layouts.mainLayout')

@section('title','Account')

@section('content')
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
	<h1> My account </h1>
	<p>
		Hello {{ session('user')->login() }} !<br>
		Welcome on your account.
	</p>
	<ul>
		<li><a href="{{ route('inventory_show') }}">View my memos.</a></li>
		<br>
		<li><a href="{{ route('view_formpassword') }}">Change password.</a></li>
		<li><a href="{{ route('user_deleteuser') }}">Delete my account.</a></li>
	</ul>
	<p><a href="signout">Sign out</a></p>
@endsection

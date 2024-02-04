@extends('layouts.mainLayout') <!-- extends -->

@section('title','Signin') <!-- remplace la prtie nommé 'title' dans le layout, par... -->

@section('content') <!-- remplace la prtie nommé 'content' dans le layout, par... -->
	<!-- @parent est un equivalent de super en java ou base en c#  -->

	<h1>Signin</h1>
	<form action="{{ route('user_authenticate') }}" method="post">
		@csrf
		<label for="email">Email</label>      <input type="text"     id="email"    name="email"    required autofocus>
		<label for="password">Password</label><input type="password" id="password" name="password" required>
		<input type="submit" value="Signin">
	</form>
	<p>
		If you don't have an account, <a href="{{ route('view_signup') }}">signup</a> first.
	</p>

	@include('shared.message')
@endsection

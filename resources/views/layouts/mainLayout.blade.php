<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>@yield('title')</title>
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
		<link rel="stylesheet" href="{{ asset('css/creature.css') }}">
		<link rel="stylesheet" href="{{ asset('css/inventory.css') }}">
		<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
	</head>
	<body>
		<nav>
			<ul>
				<li><a href="{{ route('view_home') }}">Home</a></li>
				<li><a href="{{ route('view_account') }}">Account</a></li>
				
				@if (session()->has('user') && session('user')->creatures()->first() != null)
				<li><a href="{{ route( 'creature_show', ['creature' => session('user')->creatures()->first()] ) }}">Game</a></li>
				<li><a href="{{ route('inventory_show') }}">Inventory</a></li>
				@endif
			</ul>
		</nav>
		
		@section('content')
		@show

		@include('shared.message')
	</body>
	<footer>
		
	</footer>
</html>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>@yield('title')</title>
		<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
	</head>
	<body>
		<nav>
			<ul>
				<li><a href="{{ route('view_home') }}">Home</a></li>
				<li><a href="{{ route('view_account') }}">Account</a></li>
			</ul>
		</nav>
		
		@section('content')
		@show

		@include('shared.message')
	</body>
	<footer>
		
	</footer>
</html>

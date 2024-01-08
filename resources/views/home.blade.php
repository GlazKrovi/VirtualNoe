@extends('layouts.mainLayout')

@section('title','HOME')

<!-- Nothing worth having comes easy. - Theodore Roosevelt -->
@section('content')

    <div class="home"> 
        <h1>Welcome {{ session('user') ? session('user')->login() : '' }}!</h1>
    </div>
@endsection
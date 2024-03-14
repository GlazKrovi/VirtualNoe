@extends('layouts.mainLayout')

@section('title', 'Create Animal')

<!-- It is never too late to be what you might have been. - George Eliot -->

@section('content')
    <h1>Create a Virtual Animal</h1>

    <form method="POST" action="{{ route('creature_store') }}">
        @csrf

        <label for="name">Enter the name of your new creature:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <button type="submit">Create</button>
    </form>
@endsection

@extends('layouts.mainLayout')

@section('title','Change password')

@section('content')
    <div>
        <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
        <h1>Create a memo</h1>
        <form action="{{ route('memo_add') }} " method="post">
            @csrf
            <label for="title"> Title </label> <input type="text"     id="title"    name="title"    required autofocus>
            <label for="content"> Content </label> <input type="text" id="content" name="content" required>
            <label for="public"> Is public <input type="checkbox" id="public" name="public">
            <input type="submit" value="Valider">
        </form>
        <p>
            Go back to <a href="{{ route('view_account') }}">Account</a>.
        </p>
    </div>
@endsection



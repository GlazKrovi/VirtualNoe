@extends('layouts.mainLayout')

@section('content')
    <!-- Well begun is half done. - Aristotle -->
    <div class="log">
        <h1>Log File Content</h1>
        <!-- <pre> show preformated text and keep its format -->
        <pre style="width: 100%; white-space: pre-wrap;">{{ $logContent }}</pre>       
    </div>
@endsection
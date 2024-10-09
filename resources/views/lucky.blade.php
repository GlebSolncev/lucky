@extends('layouts.app')

@section('title', 'Lucky Result')

@section('content')
    <h1>I'm Feeling Lucky Result</h1>

    <div class="card">
        <div class="card-body">
            <p>Random Number: <strong>{{ $randomNumber }}</strong></p>
            <p>Result: <strong>{{ $result }}</strong></p>
            <p>Win Amount: <strong>{{ $winAmount }}</strong></p>
        </div>
    </div>

    <a href="{{ route('dashboard', $uuid) }}" class="btn btn-primary mt-3">Return to Dashboard</a>
@endsection

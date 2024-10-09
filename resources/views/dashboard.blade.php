@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Welcome, {{ $user->username }}!</h1>

    <p>This is your unique page, accessible via a link valid for 7 days.</p>

    <div class="mb-3">
        <form method="POST" action="{{ route('dashboard.generate', $uuid) }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-secondary">Generate New Unique Link</button>
        </form>

        <form method="POST" action="{{ route('dashboard.deactivate', $uuid) }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Deactivate Unique Link</button>
        </form>
    </div>

    <div class="mb-3">
        <form method="POST" action="{{ route('dashboard.lucky', $uuid) }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">I'm Feeling Lucky</button>
        </form>

        <a href="{{ route('dashboard.history', $uuid) }}" class="btn btn-info">History</a>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'History')

@section('content')
    <h1>Last 3 Lucky Results</h1>

    @if (count($history) > 0)
        <ul class="list-group">
            @foreach($history as $entry)
                <li class="list-group-item">
                    Number: <strong>{{ $entry['number'] }}</strong>,
                    Result: <strong>{{ $entry['type'] }}</strong>,
                    Win Amount: <strong>{{ $entry['points'] }}</strong>,
                    Date: <strong>{{ \Carbon\Carbon::parse($entry['created_at'])->format('d.m.Y H:i') }}</strong>
                </li>
            @endforeach
        </ul>
    @else
        <p>You have no results yet.</p>
    @endif

    <a href="{{ route('dashboard', $uuid) }}" class="btn btn-primary mt-3">Return to Dashboard</a>
@endsection

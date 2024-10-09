@extends('layouts.app')

@section('title', 'Registration')

@section('content')
    <h1>Registration</h1>

    @include('partials.errors')

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection

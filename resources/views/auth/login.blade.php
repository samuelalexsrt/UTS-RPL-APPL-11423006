@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Login</h2>
        <p>Masuk untuk mengakses MediTrack.</p>
    </div>

    <div class="card">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>

            <label>Password</label>
            <input type="password" name="password" required>

            <label><input type="checkbox" name="remember"> Remember me</label>

            <div class="form-actions">
                <button type="submit" class="button">Login</button>
                <a href="{{ route('register') }}" class="button button-secondary">Register</a>
            </div>
        </form>
    </div>
@endsection

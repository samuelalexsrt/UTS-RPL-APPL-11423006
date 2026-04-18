@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Register</h2>
        <p>Buat akun baru untuk menggunakan MediTrack.</p>
    </div>

    <div class="card">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>

            <label>Role</label>
            <select name="role">
                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
                <option value="pharmacist">Pharmacist</option>
            </select>

            <div class="form-actions">
                <button type="submit" class="button">Register</button>
                <a href="{{ route('login') }}" class="button button-secondary">Login</a>
            </div>
        </form>
    </div>
@endsection

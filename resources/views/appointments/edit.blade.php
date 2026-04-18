@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Edit Janji Temu</h2>
        <p>Perbarui data jadwal, status, atau catatan pada janji temu pasien.</p>

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Perbaiki error berikut:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointments.update', $appointment) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Patient</label>
            <select name="patient_id">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                @endforeach
            </select>

            <label>Doctor</label>
            <select name="doctor_id">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>

            <label>Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at', $appointment->scheduled_at?->format('Y-m-d\TH:i')) }}" />

            <label>Status</label>
            <select name="status">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ old('status', $appointment->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            <label>Notes</label>
            <textarea name="notes">{{ old('notes', $appointment->notes) }}</textarea>

            <button type="submit" class="button">Perbarui Janji</button>
            <a class="button button-secondary" href="{{ route('appointments.index') }}">Kembali</a>
        </form>
    </div>
@endsection

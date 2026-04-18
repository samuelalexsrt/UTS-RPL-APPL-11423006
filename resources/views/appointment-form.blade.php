@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>{{ isset($appointment) ? 'Edit Appointment' : 'Buat Appointment Baru' }}</h2>
    </div>

    <div class="card">
        <form action="{{ isset($appointment) ? route('appointments.update', $appointment) : route('appointments.store') }}" method="POST">
            @csrf
            @if(isset($appointment))
                @method('PUT')
            @endif

            <label>Patient</label>
            <select name="patient_id" required>
                <option value="">Pilih pasien</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id', $appointment->patient_id ?? '') == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                @endforeach
            </select>

            <label>Doctor</label>
            <select name="doctor_id" required>
                <option value="">Pilih dokter</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id', $appointment->doctor_id ?? '') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>

            <label>Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at', isset($appointment) ? $appointment->scheduled_at->format('Y-m-d\TH:i') : '') }}" required>

            <label>Status</label>
            <select name="status" required>
                @foreach(['pending','confirmed','cancelled','completed'] as $status)
                    <option value="{{ $status }}" {{ old('status', $appointment->status ?? 'pending') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            <label>Notes</label>
            <textarea name="notes">{{ old('notes', $appointment->notes ?? '') }}</textarea>

            <div class="form-actions">
                <button type="submit" class="button">{{ isset($appointment) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('appointments.index') }}" class="button button-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>{{ isset($record) ? 'Edit EHR' : 'Tambah Catatan Kesehatan' }}</h2>
    </div>

    <div class="card">
        <form action="{{ isset($record) ? route('ehr.update', $record) : route('ehr.store') }}" method="POST">
            @csrf
            @if(isset($record))
                @method('PUT')
            @endif

            <label>Patient</label>
            <select name="patient_id" required>
                <option value="">Pilih pasien</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id', $record->patient_id ?? '') == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                @endforeach
            </select>

            <label>Doctor</label>
            <select name="doctor_id" required>
                <option value="">Pilih dokter</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id', $record->doctor_id ?? '') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>

            <label>Record Type</label>
            <input type="text" name="record_type" value="{{ old('record_type', $record->record_type ?? '') }}" required>

            <label>Visit Date</label>
            <input type="date" name="visit_date" value="{{ old('visit_date', isset($record) ? $record->visit_date->format('Y-m-d') : '') }}" required>

            <label>Details</label>
            <textarea name="details" required>{{ old('details', $record->details ?? '') }}</textarea>

            <div class="form-actions">
                <button type="submit" class="button">{{ isset($record) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('ehr.index') }}" class="button button-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Tambah Catatan Kesehatan</h2>
        <p>Masukkan detail kunjungan, hasil lab, dan resep untuk pasien.</p>

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

        <form action="{{ route('ehr.store') }}" method="POST">
            @csrf
            <label>Patient</label>
            <select name="patient_id">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                @endforeach
            </select>

            <label>Doctor</label>
            <select name="doctor_id">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>

            <label>Visit Date</label>
            <input type="date" name="visit_date" value="{{ old('visit_date') }}" />

            <label>Record Type</label>
            <select name="record_type">
                @foreach($types as $type)
                    <option value="{{ $type }}" {{ old('record_type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                @endforeach
            </select>

            <label>Details</label>
            <textarea name="details">{{ old('details') }}</textarea>

            <label>Lab Results</label>
            <textarea name="lab_results">{{ old('lab_results') }}</textarea>

            <label>Prescriptions</label>
            <textarea name="prescriptions">{{ old('prescriptions') }}</textarea>

            <button type="submit" class="button">Simpan Catatan</button>
            <a class="button button-secondary" href="{{ route('ehr.index') }}">Kembali</a>
        </form>
    </div>
@endsection

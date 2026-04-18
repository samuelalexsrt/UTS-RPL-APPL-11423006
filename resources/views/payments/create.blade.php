@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Tambah Transaksi Pembayaran</h2>
        <p>Buat transaksi baru untuk layanan kesehatan pasien.</p>

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

        <form action="{{ route('payments.store') }}" method="POST">
            @csrf

            <label>Patient</label>
            <select name="patient_id">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                @endforeach
            </select>

            <label>Appointment</label>
            <select name="appointment_id">
                <option value="">Tanpa appointment</option>
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>{{ $appointment->patient?->name ?? 'Unknown' }} - {{ $appointment->scheduled_at?->format('Y-m-d H:i') }}</option>
                @endforeach
            </select>

            <label>Amount</label>
            <input type="number" name="amount" min="0" step="0.01" value="{{ old('amount', 0) }}" />

            <label>Payment Method</label>
            <select name="payment_method">
                @foreach($methods as $method)
                    <option value="{{ $method }}" {{ old('payment_method') == $method ? 'selected' : '' }}>{{ ucfirst($method) }}</option>
                @endforeach
            </select>

            <label>Status</label>
            <select name="status">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            <label>Insurance Claim Number</label>
            <input type="text" name="insurance_claim_number" value="{{ old('insurance_claim_number') }}" />

            <label>Insurance Status</label>
            <input type="text" name="insurance_status" value="{{ old('insurance_status') }}" />

            <button type="submit" class="button">Simpan Transaksi</button>
            <a class="button button-secondary" href="{{ route('payments.index') }}">Kembali</a>
        </form>
    </div>
@endsection

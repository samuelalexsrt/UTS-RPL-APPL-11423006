@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Buat Pesanan Resep</h2>
        <p>Tambahkan pesanan obat pasien dengan obat yang tersedia di apotek.</p>

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

        <form action="{{ route('pharmacy.orders.store') }}" method="POST">
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

            <label>Pharmacy Stock</label>
            <select name="pharmacy_stock_id">
                <option value="">Pilih stok yang terkait</option>
                @foreach($stocks as $stock)
                    <option value="{{ $stock->id }}" {{ old('pharmacy_stock_id') == $stock->id ? 'selected' : '' }}>{{ $stock->drug_name }}</option>
                @endforeach
            </select>

            <label>Medication Name</label>
            <input type="text" name="medication_name" value="{{ old('medication_name') }}" />

            <label>Dosage</label>
            <input type="text" name="dosage" value="{{ old('dosage') }}" />

            <label>Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" />

            <label>Status</label>
            <select name="status">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            <button type="submit" class="button">Simpan Pesanan</button>
            <a class="button button-secondary" href="{{ route('pharmacy.index') }}">Kembali</a>
        </form>
    </div>
@endsection

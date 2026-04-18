@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Edit Pesanan Resep</h2>
        <p>Perbarui detail resep pasien, stok terkait, atau status pesanan.</p>

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

        <form action="{{ route('pharmacy.orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Patient</label>
            <select name="patient_id">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id', $order->patient_id) == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                @endforeach
            </select>

            <label>Doctor</label>
            <select name="doctor_id">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id', $order->doctor_id) == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>

            <label>Pharmacy Stock</label>
            <select name="pharmacy_stock_id">
                <option value="">Pilih stok yang terkait</option>
                @foreach($stocks as $stock)
                    <option value="{{ $stock->id }}" {{ old('pharmacy_stock_id', $order->pharmacy_stock_id) == $stock->id ? 'selected' : '' }}>{{ $stock->drug_name }}</option>
                @endforeach
            </select>

            <label>Medication Name</label>
            <input type="text" name="medication_name" value="{{ old('medication_name', $order->medication_name) }}" />

            <label>Dosage</label>
            <input type="text" name="dosage" value="{{ old('dosage', $order->dosage) }}" />

            <label>Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity', $order->quantity) }}" min="1" />

            <label>Status</label>
            <select name="status">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ old('status', $order->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            <button type="submit" class="button">Perbarui Pesanan</button>
            <a class="button button-secondary" href="{{ route('pharmacy.index') }}">Kembali</a>
        </form>
    </div>
@endsection

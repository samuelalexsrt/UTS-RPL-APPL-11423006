@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>{{ isset($prescription) ? 'Edit Pesanan Resep' : 'Buat Pesanan Resep' }}</h2>
    </div>

    <div class="card">
        <form action="{{ isset($prescription) ? route('prescriptions.update', $prescription) : route('prescriptions.store') }}" method="POST">
            @csrf
            @if(isset($prescription))
                @method('PUT')
            @endif

            <label>Patient</label>
            <select name="patient_id" required>
                <option value="">Pilih pasien</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id', $prescription->patient_id ?? '') == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                @endforeach
            </select>

            <label>Medicine</label>
            <select name="pharmacy_stock_id" required>
                <option value="">Pilih obat</option>
                @foreach($stocks as $stock)
                    <option value="{{ $stock->id }}" {{ old('pharmacy_stock_id', $prescription->pharmacy_stock_id ?? '') == $stock->id ? 'selected' : '' }}>{{ $stock->name }} ({{ $stock->quantity }} available)</option>
                @endforeach
            </select>

            <label>Quantity</label>
            <input type="number" name="quantity" min="1" value="{{ old('quantity', $prescription->quantity ?? 1) }}" required>

            @if(isset($prescription))
                <label>Status</label>
                <select name="status" required>
                    @foreach(['pending','approved','fulfilled','cancelled'] as $status)
                        <option value="{{ $status }}" {{ old('status', $prescription->status ?? '') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            @endif

            <label>Instructions</label>
            <textarea name="instructions">{{ old('instructions', $prescription->instructions ?? '') }}</textarea>

            <div class="form-actions">
                <button type="submit" class="button">{{ isset($prescription) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('prescriptions.index') }}" class="button button-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection

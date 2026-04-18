@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>{{ isset($payment) ? 'Edit Pembayaran' : 'Tambah Pembayaran' }}</h2>
    </div>

    <div class="card">
        <form action="{{ isset($payment) ? route('payments.update', $payment) : route('payments.store') }}" method="POST">
            @csrf
            @if(isset($payment))
                @method('PUT')
            @endif

            <label>Appointment</label>
            <select name="appointment_id" required>
                <option value="">Pilih appointment</option>
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}" {{ old('appointment_id', $payment->appointment_id ?? '') == $appointment->id ? 'selected' : '' }}>{{ $appointment->patient?->name }} - {{ $appointment->scheduled_at->format('Y-m-d H:i') }}</option>
                @endforeach
            </select>

            <label>Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount', $payment->amount ?? '') }}" min="0" required>

            <label>Status</label>
            <select name="status" required>
                @foreach(['pending','paid','failed'] as $status)
                    <option value="{{ $status }}" {{ old('status', $payment->status ?? 'pending') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            <label>Notes</label>
            <textarea name="notes">{{ old('notes', $payment->notes ?? '') }}</textarea>

            <div class="form-actions">
                <button type="submit" class="button">{{ isset($payment) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('payments.index') }}" class="button button-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection

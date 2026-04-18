@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Payment System</h2>
        <p>Menangani pembayaran online dan klaim asuransi untuk layanan kesehatan.</p>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Appointment</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Insurance</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->patient?->name ?? 'Unknown' }}</td>
                        <td>{{ $payment->appointment_id ?? 'N/A' }}</td>
                        <td>Rp {{ number_format($payment->amount, 2, ',', '.') }}</td>
                        <td>{{ ucfirst($payment->payment_method) }}</td>
                        <td>{{ ucfirst($payment->status) }}</td>
                        <td>{{ $payment->insurance_status ? ucfirst($payment->insurance_status) : 'Tidak ada' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6">Belum ada transaksi pembayaran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

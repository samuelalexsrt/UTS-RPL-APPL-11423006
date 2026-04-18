@extends('layouts.app')

@section('content')
    <div class="card">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
            <div>
                <h2>Payment System</h2>
                <p>Menangani pembayaran online, tunai, dan klaim asuransi untuk layanan kesehatan.</p>
            </div>
            <a class="button" href="{{ route('payments.create') }}">Tambah Transaksi</a>
        </div>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->patient?->name ?? 'Unknown' }}</td>
                        <td>{{ $payment->appointment?->scheduled_at?->format('Y-m-d H:i') ?? 'N/A' }}</td>
                        <td>Rp {{ number_format($payment->amount, 2, ',', '.') }}</td>
                        <td>{{ ucfirst($payment->payment_method) }}</td>
                        <td>{{ ucfirst($payment->status) }}</td>
                        <td>{{ $payment->insurance_status ? ucfirst($payment->insurance_status) : 'Tidak ada' }}</td>
                        <td>
                            <a href="{{ route('payments.edit', $payment) }}">Edit</a>
                            <form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline-block; margin-left:10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">Belum ada transaksi pembayaran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

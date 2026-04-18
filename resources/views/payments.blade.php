@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <div class="card" style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
        <div>
            <h2>Payment Transactions</h2>
            <p>Catat pembayaran pasien dan klaim asuransi.</p>
        </div>
        <a class="button" href="{{ route('payments.create') }}">Tambah Pembayaran</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Appointment</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->patient?->name ?? 'Unknown' }}</td>
                        <td>{{ $payment->appointment?->scheduled_at?->format('Y-m-d') ?? 'N/A' }}</td>
                        <td>Rp {{ number_format($payment->amount, 2, ',', '.') }}</td>
                        <td>{{ ucfirst($payment->status) }}</td>
                        <td>{{ Str::limit($payment->notes, 80) }}</td>
                        <td>
                            <a href="{{ route('payments.edit', $payment) }}">Edit</a>
                            <form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline-block; margin-left:10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus pembayaran ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada transaksi pembayaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="card">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
            <div>
                <h2>Daftar Pesanan Resep</h2>
                <p>Kelola pesanan obat pasien dan status pengirimannya.</p>
            </div>
            <a class="button" href="{{ route('pharmacy.orders.create') }}">Buat Pesanan Resep</a>
        </div>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Medication</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->patient?->name ?? 'Unknown' }}</td>
                        <td>{{ $order->doctor?->name ?? 'Unknown' }}</td>
                        <td>{{ $order->medication_name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <a href="{{ route('pharmacy.orders.edit', $order) }}">Edit</a>
                            <form action="{{ route('pharmacy.orders.destroy', $order) }}" method="POST" style="display:inline-block; margin-left:10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus pesanan resep ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">Tidak ada pesanan resep.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

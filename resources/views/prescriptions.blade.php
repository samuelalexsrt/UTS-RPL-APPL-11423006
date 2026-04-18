@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <div class="card" style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
        <div>
            <h2>Prescription Orders</h2>
            <p>Cek status resep dan pengambilan obat.</p>
        </div>
        <a class="button" href="{{ route('prescriptions.create') }}">Buat Pesanan Resep</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Medicine</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Instructions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->patient?->name ?? 'Unknown' }}</td>
                        <td>{{ $order->stock?->name ?? 'Unknown' }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ Str::limit($order->instructions, 80) }}</td>
                        <td>
                            <a href="{{ route('prescriptions.edit', $order) }}">Edit</a>
                            <form action="{{ route('prescriptions.destroy', $order) }}" method="POST" style="display:inline-block; margin-left:10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus pesanan resep ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada pesanan resep.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

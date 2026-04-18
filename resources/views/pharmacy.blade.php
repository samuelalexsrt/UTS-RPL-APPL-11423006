@extends('layouts.app')

@section('content')
    <div class="card">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
            <div>
                <h2>Pharmacy Integration</h2>
                <p>Kelola stok obat, pesanan resep, dan status pemrosesan apotek.</p>
            </div>
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <a class="button" href="{{ route('pharmacy.stocks.create') }}">Tambah Stok</a>
                <a class="button" href="{{ route('pharmacy.orders.create') }}">Tambah Pesanan</a>
            </div>
        </div>
    </div>

    <div class="card">
        <h3>Stock Farmasi</h3>
        <table>
            <thead>
                <tr>
                    <th>Drug</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $stock)
                    <tr>
                        <td>{{ $stock->drug_name }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>{{ $stock->supplier }}</td>
                        <td>{{ $stock->last_updated_at?->format('Y-m-d H:i') ?? 'TBD' }}</td>
                        <td>
                            <a href="{{ route('pharmacy.stocks.edit', $stock) }}">Edit</a>
                            <form action="{{ route('pharmacy.stocks.destroy', $stock) }}" method="POST" style="display:inline-block; margin-left:10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus stok farmasi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Tidak ada stok farmasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3>Prescription Orders</h3>
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

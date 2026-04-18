@extends('layouts.app')

@section('content')
    <div class="card">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
            <div>
                <h2>Daftar Stok Farmasi</h2>
                <p>Kelola persediaan obat yang tersedia di apotek.</p>
            </div>
            <a class="button" href="{{ route('pharmacy.stocks.create') }}">Tambah Stok</a>
        </div>
    </div>

    <div class="card">
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
@endsection

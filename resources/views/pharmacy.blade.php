@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <div class="card" style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
        <div>
            <h2>Pharmacy Stock</h2>
            <p>Kelola stok obat, harga, dan ketersediaan.</p>
        </div>
        <a class="button" href="{{ route('pharmacy.create') }}">Tambah Stok Obat</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ Str::limit($item->description, 80) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('pharmacy.edit', $item) }}">Edit</a>
                            <form action="{{ route('pharmacy.destroy', $item) }}" method="POST" style="display:inline-block; margin-left:10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus item stok ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada stok obat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Tambah Stok Farmasi</h2>
        <p>Masukkan obat baru dan jumlah persediaan yang tersedia.</p>

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Perbaiki error berikut:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pharmacy.stocks.store') }}" method="POST">
            @csrf
            <label>Drug Name</label>
            <input type="text" name="drug_name" value="{{ old('drug_name') }}" />

            <label>Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity', 0) }}" min="0" />

            <label>Supplier</label>
            <input type="text" name="supplier" value="{{ old('supplier') }}" />

            <label>Last Updated At</label>
            <input type="datetime-local" name="last_updated_at" value="{{ old('last_updated_at') }}" />

            <button type="submit" class="button">Simpan Stok</button>
            <a class="button button-secondary" href="{{ route('pharmacy.index') }}">Kembali</a>
        </form>
    </div>
@endsection

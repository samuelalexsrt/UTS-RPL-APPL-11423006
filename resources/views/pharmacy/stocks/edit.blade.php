@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Edit Stok Farmasi</h2>
        <p>Perbarui detail obat dan jumlah persediaan.</p>

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

        <form action="{{ route('pharmacy.stocks.update', $stock) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Drug Name</label>
            <input type="text" name="drug_name" value="{{ old('drug_name', $stock->drug_name) }}" />

            <label>Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity', $stock->quantity) }}" min="0" />

            <label>Supplier</label>
            <input type="text" name="supplier" value="{{ old('supplier', $stock->supplier) }}" />

            <label>Last Updated At</label>
            <input type="datetime-local" name="last_updated_at" value="{{ old('last_updated_at', $stock->last_updated_at?->format('Y-m-d\TH:i')) }}" />

            <button type="submit" class="button">Perbarui Stok</button>
            <a class="button button-secondary" href="{{ route('pharmacy.index') }}">Kembali</a>
        </form>
    </div>
@endsection

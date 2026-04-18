@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>{{ isset($item) ? 'Edit Stock Item' : 'Tambah Stock Item' }}</h2>
    </div>

    <div class="card">
        <form action="{{ isset($item) ? route('pharmacy.update', $item) : route('pharmacy.store') }}" method="POST">
            @csrf
            @if(isset($item))
                @method('PUT')
            @endif

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" required>

            <label>Description</label>
            <textarea name="description">{{ old('description', $item->description ?? '') }}</textarea>

            <label>Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity', $item->quantity ?? 0) }}" min="0" required>

            <label>Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $item->price ?? 0) }}" min="0" required>

            <div class="form-actions">
                <button type="submit" class="button">{{ isset($item) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('pharmacy.index') }}" class="button button-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection

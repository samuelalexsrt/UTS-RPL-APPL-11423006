@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Dashboard MediTrack</h2>
        <p>Ringkasan operasi dan data klinis untuk user Anda.</p>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Appointments</h3>
            <p>{{ $stats['appointments'] ?? 0 }} data</p>
        </div>
        <div class="card">
            <h3>Clinical Records</h3>
            <p>{{ $stats['records'] ?? $stats['prescriptions'] ?? 0 }} data</p>
        </div>
        <div class="card">
            <h3>Payments</h3>
            <p>{{ $stats['payments'] ?? 0 }} transaksi</p>
        </div>
        <div class="card">
            <h3>Pharmacy Stock</h3>
            <p>{{ $stats['stock_items'] ?? 0 }} item</p>
        </div>
    </div>

    <div class="card">
        <h3>Mulai</h3>
        <p>Gunakan menu untuk membuat appointment, mencatat EHR, memperbarui stok apotek, atau memproses pembayaran.</p>
    </div>
@endsection

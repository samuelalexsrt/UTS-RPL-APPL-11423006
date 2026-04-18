@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Platform Overview</h2>
        <p>MediTrack menyatukan user management, appointment scheduling, electronic health records, pharmacy integration, analytics, dan sistem pembayaran dalam satu solusi Laravel.</p>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Users</h3>
            <p class="badge">Patients: {{ $patientCount }}</p>
            <p class="badge">Doctors: {{ $doctorCount }}</p>
            <p class="badge">Pharmacists: {{ $pharmacistCount }}</p>
        </div>
        <div class="card">
            <h3>Clinical Services</h3>
            <p class="badge">Appointments: {{ $appointmentCount }}</p>
            <p class="badge">EHR records: {{ $ehrCount }}</p>
            <p class="badge">Prescriptions: {{ $prescriptionCount }}</p>
        </div>
        <div class="card">
            <h3>Operational Data</h3>
            <p class="badge">Pharmacy stock items: {{ $pharmacyStockCount }}</p>
            <p class="badge">Payments: {{ $paymentCount }}</p>
        </div>
    </div>

    <div class="card">
        <h3>Key Capabilities</h3>
        <ul>
            <li>Manajemen peran pasien, dokter, apoteker, dan admin</li>
            <li>Jadwal janji temu, pembatalan, dan pelacakan status</li>
            <li>Catatan medis elektronik dengan riwayat kunjungan dan hasil lab</li>
            <li>Integrasi stok farmasi dan pesanan resep</li>
            <li>Transaksi pembayaran dengan klaim asuransi</li>
        </ul>
    </div>
@endsection

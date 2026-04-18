@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <div class="card">
        <h2>Electronic Health Records</h2>
        <p>Catatan kesehatan pasien, resep, hasil laboratorium, dan riwayat kunjungan dokter.</p>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Type</th>
                    <th>Visit Date</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr>
                        <td>{{ $record->patient?->name ?? 'Unknown' }}</td>
                        <td>{{ $record->doctor?->name ?? 'Unknown' }}</td>
                        <td>{{ ucfirst($record->record_type) }}</td>
                        <td>{{ $record->visit_date?->format('Y-m-d') ?? 'TBD' }}</td>
                        <td>{{ Str::limit($record->details, 80) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada data EHR.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

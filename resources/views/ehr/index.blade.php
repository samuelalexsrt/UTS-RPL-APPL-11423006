@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <div class="card">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
            <div>
                <h2>Electronic Health Records</h2>
                <p>Catatan kesehatan pasien, resep, hasil laboratorium, dan riwayat kunjungan dokter.</p>
            </div>
            <a class="button" href="{{ route('ehr.create') }}">Tambah EHR</a>
        </div>
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
                    <th>Actions</th>
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
                        <td>
                            <a href="{{ route('ehr.edit', $record) }}">Edit</a>
                            <form action="{{ route('ehr.destroy', $record) }}" method="POST" style="display:inline-block; margin-left:10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus catatan kesehatan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada data EHR.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

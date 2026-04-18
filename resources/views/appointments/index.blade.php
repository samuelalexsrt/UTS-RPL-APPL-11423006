@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <div class="card">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
            <div>
                <h2>Appointment Scheduling</h2>
                <p>Kelola jadwal pasien dan dokter, termasuk booking, status konfirmasi, dan catatan kunjungan.</p>
            </div>
            <a class="button" href="{{ route('appointments.create') }}">Buat Janji Baru</a>
        </div>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Scheduled</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient?->name ?? 'Unknown' }}</td>
                        <td>{{ $appointment->doctor?->name ?? 'Unknown' }}</td>
                        <td>{{ $appointment->scheduled_at?->format('Y-m-d H:i') ?? 'TBD' }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        <td>{{ Str::limit($appointment->notes, 80) }}</td>
                        <td>
                            <a href="{{ route('appointments.edit', $appointment) }}">Edit</a>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display:inline-block; margin-left:10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus janji temu ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada janji temu tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

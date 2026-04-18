@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Appointment Scheduling</h2>
        <p>Kelola jadwal pasien dan dokter, termasuk booking, status konfirmasi, dan catatan kunjungan.</p>
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
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient?->name ?? 'Unknown' }}</td>
                        <td>{{ $appointment->doctor?->name ?? 'Unknown' }}</td>
                        <td>{{ $appointment->scheduled_at?->format('Y-m-d H:i') ?? 'TBD' }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        <td>{{ $appointment->notes }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada janji temu tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

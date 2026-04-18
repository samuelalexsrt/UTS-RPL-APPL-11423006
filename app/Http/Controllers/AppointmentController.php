<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('appointments.index', [
            'appointments' => Appointment::with(['patient', 'doctor'])->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('appointments.create', [
            'patients' => User::where('role', 'patient')->get(),
            'doctors' => User::where('role', 'doctor')->get(),
            'statuses' => ['pending', 'confirmed', 'completed', 'cancelled'],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'scheduled_at' => ['required', 'date'],
            'status' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
        ]);

        Appointment::create($data);

        return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil dibuat.');
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', [
            'appointment' => $appointment,
            'patients' => User::where('role', 'patient')->get(),
            'doctors' => User::where('role', 'doctor')->get(),
            'statuses' => ['pending', 'confirmed', 'completed', 'cancelled'],
        ]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'scheduled_at' => ['required', 'date'],
            'status' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
        ]);

        $appointment->update($data);

        return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil diperbarui.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil dihapus.');
    }
}

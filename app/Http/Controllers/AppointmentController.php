<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Appointment::with(['patient', 'doctor']);

        if ($user->role === 'patient') {
            $query->where('patient_id', $user->id);
        }

        if ($user->role === 'doctor') {
            $query->where('doctor_id', $user->id);
        }

        $appointments = $query->orderBy('scheduled_at', 'desc')->get();

        return view('appointments', compact('appointments'));
    }

    public function create()
    {
        $this->authorizeRole(['admin', 'patient', 'doctor']);

        $patients = User::where('role', 'patient')->get();
        $doctors = User::where('role', 'doctor')->get();

        return view('appointment-form', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $this->authorizeRole(['admin', 'patient', 'doctor']);

        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'scheduled_at' => ['required', 'date'],
            'status' => ['required', 'in:pending,confirmed,cancelled,completed'],
            'notes' => ['nullable', 'string'],
        ]);

        Appointment::create($data);

        return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil dibuat.');
    }

    public function edit(Appointment $appointment)
    {
        $this->authorizeAppointment($appointment);

        $patients = User::where('role', 'patient')->get();
        $doctors = User::where('role', 'doctor')->get();

        return view('appointment-form', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $this->authorizeAppointment($appointment);

        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'scheduled_at' => ['required', 'date'],
            'status' => ['required', 'in:pending,confirmed,cancelled,completed'],
            'notes' => ['nullable', 'string'],
        ]);

        $appointment->update($data);

        return redirect()->route('appointments.index')->with('success', 'Janji temu diperbarui.');
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorizeAppointment($appointment);

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Janji temu dihapus.');
    }

    protected function authorizeAppointment(Appointment $appointment)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'doctor' && $appointment->doctor_id === $user->id) {
            return true;
        }

        if ($user->role === 'patient' && $appointment->patient_id === $user->id) {
            return true;
        }

        abort(403);
    }

    protected function authorizeRole(array $roles)
    {
        if (! in_array(auth()->user()->role, $roles, true)) {
            abort(403);
        }
    }
}

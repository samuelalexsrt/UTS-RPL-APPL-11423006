<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Models\User;
use Illuminate\Http\Request;

class HealthRecordController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = HealthRecord::with(['patient', 'doctor']);

        if ($user->role === 'patient') {
            $query->where('patient_id', $user->id);
        }

        if ($user->role === 'doctor') {
            $query->where('doctor_id', $user->id);
        }

        $records = $query->orderBy('visit_date', 'desc')->get();

        return view('ehr', compact('records'));
    }

    public function create()
    {
        $this->authorizeRole(['admin', 'doctor']);

        $patients = User::where('role', 'patient')->get();
        $doctors = User::where('role', 'doctor')->get();

        return view('ehr-form', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $this->authorizeRole(['admin', 'doctor']);

        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'record_type' => ['required', 'string', 'max:255'],
            'visit_date' => ['required', 'date'],
            'details' => ['required', 'string'],
        ]);

        HealthRecord::create($data);

        return redirect()->route('ehr.index')->with('success', 'Catatan kesehatan berhasil ditambahkan.');
    }

    public function edit(HealthRecord $record)
    {
        $this->authorizeRecord($record);

        $patients = User::where('role', 'patient')->get();
        $doctors = User::where('role', 'doctor')->get();

        return view('ehr-form', compact('record', 'patients', 'doctors'));
    }

    public function update(Request $request, HealthRecord $record)
    {
        $this->authorizeRecord($record);

        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'record_type' => ['required', 'string', 'max:255'],
            'visit_date' => ['required', 'date'],
            'details' => ['required', 'string'],
        ]);

        $record->update($data);

        return redirect()->route('ehr.index')->with('success', 'Catatan kesehatan diperbarui.');
    }

    public function destroy(HealthRecord $record)
    {
        $this->authorizeRecord($record);

        $record->delete();

        return redirect()->route('ehr.index')->with('success', 'Catatan kesehatan dihapus.');
    }

    protected function authorizeRecord(HealthRecord $record)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'doctor' && $record->doctor_id === $user->id) {
            return true;
        }

        if ($user->role === 'patient' && $record->patient_id === $user->id) {
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

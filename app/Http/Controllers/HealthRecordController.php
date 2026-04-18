<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Models\User;
use Illuminate\Http\Request;

class HealthRecordController extends Controller
{
    public function index()
    {
        return view('ehr.index', [
            'records' => HealthRecord::with(['patient', 'doctor'])->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('ehr.create', [
            'patients' => User::where('role', 'patient')->get(),
            'doctors' => User::where('role', 'doctor')->get(),
            'types' => ['consultation', 'diagnosis', 'prescription', 'lab'],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'visit_date' => ['required', 'date'],
            'record_type' => ['required', 'string', 'max:100'],
            'details' => ['required', 'string'],
            'lab_results' => ['nullable', 'string'],
            'prescriptions' => ['nullable', 'string'],
        ]);

        HealthRecord::create($data);

        return redirect()->route('ehr.index')->with('success', 'Catatan kesehatan berhasil dibuat.');
    }

    public function edit(HealthRecord $ehr)
    {
        return view('ehr.edit', [
            'record' => $ehr,
            'patients' => User::where('role', 'patient')->get(),
            'doctors' => User::where('role', 'doctor')->get(),
            'types' => ['consultation', 'diagnosis', 'prescription', 'lab'],
        ]);
    }

    public function update(Request $request, HealthRecord $ehr)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'visit_date' => ['required', 'date'],
            'record_type' => ['required', 'string', 'max:100'],
            'details' => ['required', 'string'],
            'lab_results' => ['nullable', 'string'],
            'prescriptions' => ['nullable', 'string'],
        ]);

        $ehr->update($data);

        return redirect()->route('ehr.index')->with('success', 'Catatan kesehatan berhasil diperbarui.');
    }

    public function destroy(HealthRecord $ehr)
    {
        $ehr->delete();

        return redirect()->route('ehr.index')->with('success', 'Catatan kesehatan berhasil dihapus.');
    }
}

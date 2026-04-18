<?php

namespace App\Http\Controllers;

use App\Models\PharmacyStock;
use App\Models\PrescriptionOrder;
use App\Models\User;
use Illuminate\Http\Request;

class PrescriptionOrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = PrescriptionOrder::with(['patient', 'pharmacist', 'stock']);

        if ($user->role === 'patient') {
            $query->where('patient_id', $user->id);
        }

        if ($user->role === 'pharmacist') {
            $query->where('pharmacist_id', $user->id);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        return view('prescriptions', compact('orders'));
    }

    public function create()
    {
        $patients = User::where('role', 'patient')->get();
        $stocks = PharmacyStock::where('quantity', '>', 0)->get();

        return view('prescription-form', compact('patients', 'stocks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'pharmacy_stock_id' => ['required', 'exists:pharmacy_stocks,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'instructions' => ['nullable', 'string'],
        ]);

        $stock = PharmacyStock::findOrFail($data['pharmacy_stock_id']);
        if ($data['quantity'] > $stock->quantity) {
            return back()->withErrors(['quantity' => 'Jumlah melebihi stok tersedia'])->withInput();
        }

        PrescriptionOrder::create([
            'patient_id' => $data['patient_id'],
            'pharmacist_id' => auth()->user()->role === 'pharmacist' ? auth()->id() : null,
            'pharmacy_stock_id' => $data['pharmacy_stock_id'],
            'quantity' => $data['quantity'],
            'instructions' => $data['instructions'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('prescriptions.index')->with('success', 'Pesanan resep berhasil dibuat.');
    }

    public function edit(PrescriptionOrder $prescription)
    {
        $this->authorizePrescription($prescription);

        $patients = User::where('role', 'patient')->get();
        $stocks = PharmacyStock::all();

        return view('prescription-form', compact('prescription', 'patients', 'stocks'));
    }

    public function update(Request $request, PrescriptionOrder $prescription)
    {
        $this->authorizePrescription($prescription);

        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'pharmacy_stock_id' => ['required', 'exists:pharmacy_stocks,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:pending,approved,fulfilled,cancelled'],
            'instructions' => ['nullable', 'string'],
        ]);

        $prescription->update($data);

        return redirect()->route('prescriptions.index')->with('success', 'Pesanan resep diperbarui.');
    }

    public function destroy(PrescriptionOrder $prescription)
    {
        $this->authorizePrescription($prescription);

        $prescription->delete();

        return redirect()->route('prescriptions.index')->with('success', 'Pesanan resep dihapus.');
    }

    protected function authorizePrescription(PrescriptionOrder $prescription)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'patient' && $prescription->patient_id === $user->id) {
            return true;
        }

        if ($user->role === 'pharmacist' && $prescription->pharmacist_id === $user->id) {
            return true;
        }

        abort(403);
    }
}

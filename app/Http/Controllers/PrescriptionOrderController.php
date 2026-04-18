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
        return view('pharmacy.orders.index', [
            'orders' => PrescriptionOrder::with(['patient', 'doctor', 'pharmacyStock'])->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('pharmacy.orders.create', [
            'patients' => User::where('role', 'patient')->get(),
            'doctors' => User::where('role', 'doctor')->get(),
            'stocks' => PharmacyStock::latest()->get(),
            'statuses' => ['requested', 'ready', 'fulfilled', 'cancelled'],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'pharmacy_stock_id' => ['nullable', 'exists:pharmacy_stocks,id'],
            'medication_name' => ['required', 'string', 'max:255'],
            'dosage' => ['nullable', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'string', 'max:100'],
        ]);

        PrescriptionOrder::create($data);

        return redirect()->route('pharmacy.index')->with('success', 'Pesanan resep berhasil dibuat.');
    }

    public function edit(PrescriptionOrder $order)
    {
        return view('pharmacy.orders.edit', [
            'order' => $order,
            'patients' => User::where('role', 'patient')->get(),
            'doctors' => User::where('role', 'doctor')->get(),
            'stocks' => PharmacyStock::latest()->get(),
            'statuses' => ['requested', 'ready', 'fulfilled', 'cancelled'],
        ]);
    }

    public function update(Request $request, PrescriptionOrder $order)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'pharmacy_stock_id' => ['nullable', 'exists:pharmacy_stocks,id'],
            'medication_name' => ['required', 'string', 'max:255'],
            'dosage' => ['nullable', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'string', 'max:100'],
        ]);

        $order->update($data);

        return redirect()->route('pharmacy.index')->with('success', 'Pesanan resep berhasil diperbarui.');
    }

    public function destroy(PrescriptionOrder $order)
    {
        $order->delete();

        return redirect()->route('pharmacy.index')->with('success', 'Pesanan resep berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\PaymentTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payments.index', [
            'payments' => PaymentTransaction::with(['patient', 'appointment'])->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('payments.create', [
            'patients' => User::where('role', 'patient')->get(),
            'appointments' => Appointment::latest()->get(),
            'methods' => ['online', 'cash', 'insurance', 'card'],
            'statuses' => ['pending', 'completed', 'failed'],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'appointment_id' => ['nullable', 'exists:appointments,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'string', 'max:100'],
            'status' => ['required', 'string', 'max:100'],
            'insurance_claim_number' => ['nullable', 'string', 'max:255'],
            'insurance_status' => ['nullable', 'string', 'max:100'],
        ]);

        PaymentTransaction::create($data);

        return redirect()->route('payments.index')->with('success', 'Transaksi pembayaran berhasil dibuat.');
    }

    public function edit(PaymentTransaction $payment)
    {
        return view('payments.edit', [
            'payment' => $payment,
            'patients' => User::where('role', 'patient')->get(),
            'appointments' => Appointment::latest()->get(),
            'methods' => ['online', 'cash', 'insurance', 'card'],
            'statuses' => ['pending', 'completed', 'failed'],
        ]);
    }

    public function update(Request $request, PaymentTransaction $payment)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'appointment_id' => ['nullable', 'exists:appointments,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'string', 'max:100'],
            'status' => ['required', 'string', 'max:100'],
            'insurance_claim_number' => ['nullable', 'string', 'max:255'],
            'insurance_status' => ['nullable', 'string', 'max:100'],
        ]);

        $payment->update($data);

        return redirect()->route('payments.index')->with('success', 'Transaksi pembayaran berhasil diperbarui.');
    }

    public function destroy(PaymentTransaction $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Transaksi pembayaran berhasil dihapus.');
    }
}

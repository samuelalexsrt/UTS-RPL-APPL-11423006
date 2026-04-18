<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = PaymentTransaction::with(['patient', 'appointment']);

        if ($user->role === 'patient') {
            $query->where('patient_id', $user->id);
        }

        $payments = $query->orderBy('created_at', 'desc')->get();

        return view('payments', compact('payments'));
    }

    public function create()
    {
        $appointments = Appointment::orderBy('scheduled_at')->get();

        return view('payment-form', compact('appointments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'appointment_id' => ['required', 'exists:appointments,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:pending,paid,failed'],
            'notes' => ['nullable', 'string'],
        ]);

        $payment = PaymentTransaction::create([ 
            'patient_id' => auth()->user()->id,
            'appointment_id' => $data['appointment_id'],
            'amount' => $data['amount'],
            'status' => $data['status'],
            'notes' => $data['notes'] ?? null,
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function edit(PaymentTransaction $payment)
    {
        $this->authorizePayment($payment);

        $appointments = Appointment::orderBy('scheduled_at')->get();

        return view('payment-form', compact('payment', 'appointments'));
    }

    public function update(Request $request, PaymentTransaction $payment)
    {
        $this->authorizePayment($payment);

        $data = $request->validate([
            'appointment_id' => ['required', 'exists:appointments,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:pending,paid,failed'],
            'notes' => ['nullable', 'string'],
        ]);

        $payment->update($data);

        return redirect()->route('payments.index')->with('success', 'Pembayaran diperbarui.');
    }

    public function destroy(PaymentTransaction $payment)
    {
        $this->authorizePayment($payment);

        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Pembayaran dihapus.');
    }

    protected function authorizePayment(PaymentTransaction $payment)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'patient' && $payment->patient_id === $user->id) {
            return true;
        }

        abort(403);
    }
}

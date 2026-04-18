<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\HealthRecord;
use App\Models\PaymentTransaction;
use App\Models\PharmacyStock;
use App\Models\PrescriptionOrder;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'appointments' => Appointment::count(),
            'records' => HealthRecord::count(),
            'payments' => PaymentTransaction::count(),
            'stock_items' => PharmacyStock::count(),
            'prescriptions' => PrescriptionOrder::count(),
        ];

        if ($user->role === 'patient') {
            $stats = [
                'appointments' => Appointment::where('patient_id', $user->id)->count(),
                'records' => HealthRecord::where('patient_id', $user->id)->count(),
                'payments' => PaymentTransaction::where('patient_id', $user->id)->count(),
                'prescriptions' => PrescriptionOrder::where('patient_id', $user->id)->count(),
            ];
        }

        return view('dashboard', compact('stats'));
    }
}

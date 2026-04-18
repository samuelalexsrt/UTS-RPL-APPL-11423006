<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\HealthRecord;
use App\Models\PaymentTransaction;
use App\Models\PharmacyStock;
use App\Models\PrescriptionOrder;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'patientCount' => User::where('role', 'patient')->count(),
            'doctorCount' => User::where('role', 'doctor')->count(),
            'pharmacistCount' => User::where('role', 'pharmacist')->count(),
            'appointmentCount' => Appointment::count(),
            'ehrCount' => HealthRecord::count(),
            'pharmacyStockCount' => PharmacyStock::count(),
            'prescriptionCount' => PrescriptionOrder::count(),
            'paymentCount' => PaymentTransaction::count(),
        ]);
    }
}

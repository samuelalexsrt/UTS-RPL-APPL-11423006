<?php

namespace App\Http\Controllers;

use App\Models\PharmacyStock;
use App\Models\PrescriptionOrder;

class PharmacyController extends Controller
{
    public function index()
    {
        return view('pharmacy', [
            'stocks' => PharmacyStock::latest()->get(),
            'orders' => PrescriptionOrder::with(['patient', 'doctor'])->latest()->get(),
        ]);
    }
}

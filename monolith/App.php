<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Modules/Auth.php';
require_once __DIR__ . '/Modules/Appointment.php';
require_once __DIR__ . '/Modules/EHR.php';
require_once __DIR__ . '/Modules/Pharmacy.php';
require_once __DIR__ . '/Modules/Analytics.php';
require_once __DIR__ . '/Modules/Payment.php';

use MediTrack\Monolith\Modules\Appointment;
use MediTrack\Monolith\Modules\EHR;

echo "=== MediTrack Monolith Application Simulation ===\n\n";

// 1. Simulasi Auth
$auth = new MediTrack\Monolith\Modules\Auth();
$auth->login('admin', 'password123');

// 2. Simulasi Penjadwalan (Appointment)
$appt = new Appointment();
$appt->schedule(['patient' => 'Andi', 'doctor' => 'Dr. Smith', 'time' => '10:00 AM']);

// 3. Simulasi Catatan Medis (EHR) & Farmasi
$ehr = new EHR();
$ehr->addRecord('Andi', 'Demam Ringan', ['drug' => 'Paracetamol']);

// 4. Simulasi Pembayaran
$payment = new MediTrack\Monolith\Modules\Payment();
$payment->process(150.00);

// 5. Simulasi Analytics
$analytics = new MediTrack\Monolith\Modules\Analytics();
$analytics->generateReport();

echo "\nSimulation Finished.\n";

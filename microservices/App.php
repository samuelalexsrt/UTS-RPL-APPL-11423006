<?php

require_once __DIR__ . '/AuthService/AuthService.php';
require_once __DIR__ . '/AppointmentService/AppointmentService.php';
require_once __DIR__ . '/EHRService/EHRService.php';
require_once __DIR__ . '/PharmacyService/PharmacyService.php';
require_once __DIR__ . '/PaymentService/PaymentService.php';
require_once __DIR__ . '/AnalyticsService/AnalyticsService.php';

use MediTrack\Microservices\Auth\AuthService;
use MediTrack\Microservices\Appointment\AppointmentService;
use MediTrack\Microservices\EHR\EHRService;
use MediTrack\Microservices\Pharmacy\PharmacyService;
use MediTrack\Microservices\Payment\PaymentService;
use MediTrack\Microservices\Analytics\AnalyticsService;

echo "=== MediTrack Microservices API Connectivity Test ===\n\n";

// 1. Auth Service - Mencoba Registrasi & Auth
$auth = new AuthService();
$auth->register(['name' => 'Budi Santoso', 'email' => 'budi@example.com']);
$auth->authenticate('budi', 'password123');

// 2. Appointment Service - Cek Ketersediaan & Jadwalkan
$appt = new AppointmentService();
$appt->checkAvailability(101, '2026-05-20');
$appt->schedule('Budi', 101, '2026-05-20 10:00');

// 3. EHR Service - Tambah Record & Cek Riwayat
$ehrService = new EHRService();
$ehrService->addRecord('Budi', 'Flu Ringan', ['drug' => 'Paracetamol']);
$ehrService->getPatientHistory('Budi');

// 4. Payment Service - Proses Invoice digital
$payment = new PaymentService();
$paymentId = $payment->processInvoice(150000);
$payment->generateInvoice($paymentId);

// 5. Analytics Service - Mendapatkan Tren Bisnis
$analytics = new AnalyticsService();
$analytics->getTrends();
$analytics->getRevenue();

echo "\n--- Background Event Check ---\n";

// 6. Pharmacy Service - Mensimulasikan konsumsi event dari EHR
$pharmacyService = new PharmacyService();
if ($pharmacyService->checkInventory('Paracetamol')) {
    $pharmacyService->dispense('Paracetamol', 1);
}

echo "\nConnectivity Test Finished Successfully.\n";

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

echo "=== MediTrack Microservices Architecture Simulation ===\n\n";

// 1. Auth Service
$auth = new AuthService();
$auth->authenticate('user1', 'pass123');

// 2. Appointment Service (NEW)
$appt = new AppointmentService();
$appt->schedule('Budi', 'Dr. Smith', '2026-05-20 10:00');

// 3. EHR Service mencatat diagnosa & trigger event
$ehrService = new EHRService();
$ehrService->addRecord('Budi', 'Batuk Berdahak', ['drug' => 'Amoxicillin']);

// 4. Payment Service memproses biaya
$payment = new PaymentService();
$payment->processInvoice(200.00);

// 5. Analytics Service bekerja secara independen
$analytics = new AnalyticsService();
$analytics->generateHealthInsights();

echo "\n--- Background Processing (Simulated) ---\n";

// 6. Pharmacy Service menerima event (simulasi manual)
$pharmacyService = new PharmacyService();
if ($pharmacyService->checkInventory('Amoxicillin')) {
    $pharmacyService->dispense('Amoxicillin', 1);
}

echo "\nSimulation Finished.\n";

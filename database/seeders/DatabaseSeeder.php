<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\HealthRecord;
use App\Models\PaymentTransaction;
use App\Models\PharmacyStock;
use App\Models\PrescriptionOrder;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $patient = User::factory()->create([
            'name' => 'Alya Patient',
            'email' => 'patient@example.com',
            'role' => 'patient',
        ]);

        $doctor = User::factory()->create([
            'name' => 'Dr. Bima',
            'email' => 'doctor@example.com',
            'role' => 'doctor',
        ]);

        $pharmacist = User::factory()->create([
            'name' => 'Rudi Pharmacist',
            'email' => 'pharmacist@example.com',
            'role' => 'pharmacist',
        ]);

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'scheduled_at' => now()->addDays(2),
            'status' => 'pending',
            'notes' => 'Konsultasi awal untuk nyeri punggung.',
        ]);

        HealthRecord::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'visit_date' => now()->subDays(5),
            'record_type' => 'consultation',
            'details' => 'Pemeriksaan fisik dan keluhan awal pasien.',
            'lab_results' => 'Tekanan darah dan kadar gula dalam batas normal.',
            'prescriptions' => 'Paracetamol 500mg 2x sehari selama 5 hari.',
        ]);

        $stock = PharmacyStock::create([
            'drug_name' => 'Paracetamol 500mg',
            'quantity' => 120,
            'supplier' => 'PT Obat Sehat',
            'last_updated_at' => now()->subDay(),
        ]);

        PrescriptionOrder::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'pharmacy_stock_id' => $stock->id,
            'medication_name' => 'Paracetamol 500mg',
            'dosage' => '2 tablet sehari',
            'quantity' => 10,
            'status' => 'requested',
        ]);

        PaymentTransaction::create([
            'patient_id' => $patient->id,
            'appointment_id' => $appointment->id,
            'amount' => 250000.00,
            'payment_method' => 'online',
            'status' => 'pending',
            'insurance_claim_number' => 'CLAIM-12345',
            'insurance_status' => 'approved',
        ]);
    }
}

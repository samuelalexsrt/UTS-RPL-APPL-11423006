<?php

namespace MediTrack\Microservices\Appointment;

require_once __DIR__ . '/../Common/Infrastructure.php';

use MediTrack\Microservices\Common\ServiceDatabase;
use MediTrack\Microservices\Common\ApiGateway;

class AppointmentService {
    private $db;
    private $gateway;

    public function __construct() {
        $this->db = new ServiceDatabase('AppointmentDB');
        $this->gateway = new ApiGateway();
    }

    public function checkAvailability($doctorId, $date) {
        echo "[AppointmentService] Mengecek ketersediaan Dokter $doctorId pada $date via API\n";
        return true;
    }

    public function schedule($patientId, $doctorId, $dateTime) {
        echo "[AppointmentService] Scheduling appointment for Patient $patientId with Doctor $doctorId at $dateTime\n";
        
        // Simulating Auth check via Gateway
        $this->gateway->route('AuthService', 'validate', ['patientId' => $patientId]);
        
        return $this->db->insert([
            'patientId' => $patientId,
            'doctorId' => $doctorId,
            'time' => $dateTime,
            'status' => 'scheduled'
        ]);
    }

    public function cancel($appointmentId) {
        echo "[AppointmentService] CANCEL: Membatalkan janji temu ID $appointmentId\n";
        return true;
    }
}

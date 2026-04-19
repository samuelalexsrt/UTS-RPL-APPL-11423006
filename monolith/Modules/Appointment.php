<?php

namespace MediTrack\Monolith\Modules;

use MediTrack\Monolith\Database;

class Appointment {
    public function checkAvailability($doctorId, $date) {
        echo "[Appointment] Mengecek ketersediaan dokter ID $doctorId pada $date\n";
        return true;
    }

    public function schedule($data) {
        $db = Database::getInstance();
        echo "[Appointment] Menjadwalkan pertemuan untuk " . $data['patient'] . " dengan Dokter ID " . $data['doctorId'] . "\n";
        return $db->query('appointments', 'insert', $data);
    }

    public function cancel($appointmentId) {
        echo "[Appointment] Membatalkan janji temu ID $appointmentId\n";
        return true;
    }
}

<?php

namespace MediTrack\Monolith\Modules;

use MediTrack\Monolith\Database;

class Appointment {
    public function schedule($data) {
        $db = Database::getInstance();
        echo "[Appointment] Menjadwalkan pertemuan untuk " . $data['patient'] . "\n";
        return $db->query('appointments', 'insert', $data);
    }
}

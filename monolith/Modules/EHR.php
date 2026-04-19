<?php

namespace MediTrack\Monolith\Modules;

use MediTrack\Monolith\Database;

class EHR {
    public function addRecord($patientId, $diagnosis, $prescription) {
        $db = Database::getInstance();
        echo "[EHR] Menambahkan catatan medis untuk Pasien $patientId\n";
        
        // TIGHT COUPLING: Direct call to Pharmacy module
        $pharmacy = new Pharmacy();
        if ($pharmacy->checkInventory($prescription['drug']) > 0) {
            $pharmacy->dispense($prescription['drug'], 1);
        } else {
            echo "[EHR] Peringatan: Obat " . $prescription['drug'] . " tidak tersedia!\n";
        }

        return $db->query('ehr', 'insert', ['patient' => $patientId, 'diag' => $diagnosis]);
    }

    public function getPatientHistory($patientId) {
        $db = Database::getInstance();
        echo "[EHR] Mengambil riwayat medis untuk Pasien $patientId\n";
        return $db->query('ehr', 'select');
    }
}

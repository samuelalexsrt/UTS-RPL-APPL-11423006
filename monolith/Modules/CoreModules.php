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

class Pharmacy {
    public function checkInventory($drugName) {
        $db = Database::getInstance();
        $inventory = $db->query('inventory', 'select');
        return $inventory[$drugName] ?? 0;
    }

    public function dispense($drugName, $qty) {
        echo "[Pharmacy] Mengeluarkan $qty unit $drugName\n";
        // Simulasi update stok langsung di DB
        return true;
    }
}

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
}

class Auth {
    public function login($username, $password) {
        echo "[Auth] User '$username' logged in.\n";
        return true;
    }
}

class Analytics {
    public function generateReport() {
        $db = Database::getInstance();
        $ehr = $db->query('ehr', 'select');
        echo "[Analytics] Generating report from " . count($ehr) . " records\n";
        return "Report Data";
    }
}

class Payment {
    public function process($amount) {
        $db = Database::getInstance();
        echo "[Payment] Processing payment of $$$amount\n";
        return $db->query('payments', 'insert', ['amount' => $amount, 'status' => 'paid']);
    }
}

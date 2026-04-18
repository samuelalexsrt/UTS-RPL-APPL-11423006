<?php

namespace MediTrack\Microservices\Pharmacy;

require_once __DIR__ . '/../Common/Infrastructure.php';

use MediTrack\Microservices\Common\ServiceDatabase;

class PharmacyService {
    private $db;

    public function __construct() {
        $this->db = new ServiceDatabase('PharmacyDB');
    }

    public function checkInventory($drugName) {
        echo "[PharmacyService] Checking inventory for $drugName\n";
        return true; // Simulasi stok tersedia
    }

    public function dispense($drugName, $qty) {
        echo "[PharmacyService] Dispensing $qty units of $drugName\n";
        return $this->db->insert(['action' => 'dispense', 'drug' => $drugName, 'qty' => $qty]);
    }
}

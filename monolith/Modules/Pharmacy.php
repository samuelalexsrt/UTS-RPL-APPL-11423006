<?php

namespace MediTrack\Monolith\Modules;

use MediTrack\Monolith\Database;

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

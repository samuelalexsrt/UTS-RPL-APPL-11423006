<?php

namespace MediTrack\Monolith\Modules;

use MediTrack\Monolith\Database;

class Payment {
    public function process($amount) {
        $db = Database::getInstance();
        echo "[Payment] Processing payment of $$$amount\n";
        return $db->query('payments', 'insert', ['amount' => $amount, 'status' => 'paid']);
    }
}

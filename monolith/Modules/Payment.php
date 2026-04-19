<?php

namespace MediTrack\Monolith\Modules;

use MediTrack\Monolith\Database;

class Payment {
    public function process($amount) {
        $db = Database::getInstance();
        echo "[Payment] Memproses pembayaran sebesar Rp " . number_format($amount, 0, ',', '.') . "\n";
        return $db->query('payments', 'insert', ['amount' => $amount, 'status' => 'paid']);
    }

    public function generateInvoice($paymentId) {
        echo "[Payment] Menghasilkan Invoice untuk pembayaran ID $paymentId\n";
        return "INV-" . $paymentId . "-" . date('Ymd');
    }
}

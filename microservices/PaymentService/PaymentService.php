<?php

namespace MediTrack\Microservices\Payment;

require_once __DIR__ . '/../Common/Infrastructure.php';

use MediTrack\Microservices\Common\ServiceDatabase;

class PaymentService {
    private $db;

    public function __construct() {
        $this->db = new ServiceDatabase('PaymentDB');
    }

    public function processInvoice($amount) {
        echo "[PaymentService] Processing invoice for Rp " . number_format($amount, 0, ',', '.') . "\n";
        return $this->db->insert(['amount' => $amount, 'status' => 'pending']);
    }

    public function generateInvoice($paymentId) {
        echo "[PaymentService] INVOICE: Menghasilkan faktur digital untuk ID $paymentId\n";
        return "DIGI-INV-" . $paymentId;
    }
}

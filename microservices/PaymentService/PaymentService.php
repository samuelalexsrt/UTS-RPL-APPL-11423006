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
        echo "[PaymentService] Processing invoice for $$$amount\n";
        return $this->db->insert(['amount' => $amount, 'status' => 'pending']);
    }
}

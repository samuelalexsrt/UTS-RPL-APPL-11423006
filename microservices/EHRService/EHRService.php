<?php

namespace MediTrack\Microservices\EHR;

require_once __DIR__ . '/../Common/Infrastructure.php';

use MediTrack\Microservices\Common\ServiceDatabase;
use MediTrack\Microservices\Common\MessageBus;

class EHRService {
    private $db;
    private $eventBus;

    public function __construct() {
        $this->db = new ServiceDatabase('EHR_Database');
        $this->eventBus = new MessageBus();
    }

    public function addRecord($patientId, $diagnosis, $prescription) {
        echo "[EHRService] Adding record for Pasien $patientId\n";
        $this->db->insert(['patient' => $patientId, 'diag' => $diagnosis]);

        // DECOUPLED COMMUNICATION: Publishing an event
        echo "[EHRService] Requesting pharmacy fulfillment via Event...\n";
        $this->eventBus->publish('medication.prescribed', [
            'patientId' => $patientId,
            'drug' => $prescription['drug'],
            'qty' => 1
        ]);

        // Triger Analytics Event
        $this->eventBus->publish('visit.completed', ['patientId' => $patientId, 'type' => 'OPD']);

        return true;
    }

    public function getPatientHistory($patientId) {
        echo "[EHRService] HISTORY: Mengambil riwayat Pasien $patientId dari database mandiri\n";
        return $this->db->select(['patient' => $patientId]);
    }
}

<?php

namespace MediTrack\Monolith\Modules;

use MediTrack\Monolith\Database;

class Analytics {
    public function generateReport() {
        $db = Database::getInstance();
        $ehr = $db->query('ehr', 'select');
        echo "[Analytics] Generating report from " . count($ehr) . " records\n";
        return "Report Data";
    }
}

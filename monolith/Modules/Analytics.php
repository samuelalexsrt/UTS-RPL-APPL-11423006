<?php

namespace MediTrack\Monolith\Modules;

use MediTrack\Monolith\Database;

class Analytics {
    public function generateReport() {
        $db = Database::getInstance();
        $ehr = $db->query('ehr', 'select');
        echo "[Analytics] Menghasilkan laporan dari " . count($ehr) . " rekam medis\n";
        return "Laporan Dasar";
    }

    public function getVisitTrends() {
        echo "[Analytics] Menganalisis tren kunjungan pasien (Meningkat 15% bulan ini)\n";
        return ['trend' => 'up', 'percentage' => 15];
    }

    public function getRevenueReport() {
        echo "[Analytics] Menghitung pendapatan bulanan: Rp 150.000.000\n";
        return ['monthly_revenue' => 150000000];
    }
}

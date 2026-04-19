<?php

namespace MediTrack\Microservices\Analytics;

require_once __DIR__ . '/../Common/Infrastructure.php';

use MediTrack\Microservices\Common\ServiceDatabase;

class AnalyticsService {
    private $db;

    public function __construct() {
        $this->db = new ServiceDatabase('AnalyticsDB');
    }

    public function generateHealthInsights() {
        echo "[AnalyticsService] Generating insights from local service data\n";
        return "Insights Data";
    }

    public function getTrends() {
        echo "[AnalyticsService] TRENDS: Menganalisis data dari event stream (Pasien naik 10%)\n";
        return ['status' => 'growing'];
    }

    public function getRevenue() {
        echo "[AnalyticsService] REVENUE: Menghitung total transaksi lintas layanan\n";
        return 5000000;
    }
}

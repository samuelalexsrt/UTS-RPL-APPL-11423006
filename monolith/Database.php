<?php

namespace MediTrack\Monolith;

/**
 * Simulasi Database Tunggal (Shared Database)
 * Digunakan secara langsung oleh semua modul.
 */
class Database {
    private static $instance = null;
    private $data = [];

    private function __construct() {
        // Inisialisasi data simulasi
        $this->data = [
            'users' => [],
            'appointments' => [],
            'inventory' => ['Paracetamol' => 100, 'Amoxicillin' => 50],
            'ehr' => [],
            'payments' => []
        ];
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($table, $action, $payload = null) {
        echo "[DB Query] Action '$action' on table '$table'\n";
        // Simulasi logika DB sederhana
        if ($action == 'insert') {
            $this->data[$table][] = $payload;
            return true;
        }
        return $this->data[$table];
    }
}

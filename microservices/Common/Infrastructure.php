<?php

namespace MediTrack\Microservices\Common;

/**
 * Simulasi Service Discovery
 * Melacak lokasi (URL/IP) dari setiap service.
 */
class ServiceDiscovery {
    private $services = [
        'AuthService' => 'http://10.0.0.1:8081',
        'AppointmentService' => 'http://10.0.0.2:8082',
        'EHRService' => 'http://10.0.0.3:8083',
        'PharmacyService' => 'http://10.0.0.4:8084',
        'PaymentService' => 'http://10.0.0.5:8085',
        'AnalyticsService' => 'http://10.0.0.6:8086',
    ];

    public function lookup($serviceName) {
        $address = $this->services[$serviceName] ?? 'unknown';
        echo "[Service Discovery] Resolved $serviceName to $address\n";
        return $address;
    }
}

/**
 * Simulasi API Gateway
 * Mengarahkan request ke service yang tepat.
 */
class ApiGateway {
    private $discovery;

    public function __construct() {
        $this->discovery = new ServiceDiscovery();
    }

    public function route($serviceName, $action, $payload) {
        $address = $this->discovery->lookup($serviceName);
        echo "[API Gateway] Routing request to $serviceName at $address ($action)\n";
        // Simulasi network call ke service
        return true; 
    }
}

/**
 * Simulasi Message Bus / Event Bus
 * Memungkinkan komunikasi asinkron (Pub/Sub).
 */
class MessageBus {
    public function publish($topic, $message) {
        echo "[MessageBus] Event published to topic '$topic': " . json_encode($message) . "\n";
    }
}

/**
 * Database per Service
 */
class ServiceDatabase {
    private $tableName;
    private $data = [];

    public function __construct($tableName) {
        $this->tableName = $tableName;
    }

    public function insert($payload) {
        echo "[DB: $this->tableName] Data inserted.\n";
        $this->data[] = $payload;
        return true;
    }
}

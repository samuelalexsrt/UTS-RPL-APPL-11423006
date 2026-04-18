<?php

namespace MediTrack\Microservices\Common;

/**
 * Simulasi API Gateway
 * Mengarahkan request ke service yang tepat.
 */
class ApiGateway {
    public function route($serviceName, $action, $payload) {
        echo "[API Gateway] Routing request to $serviceName ($action)\n";
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

<?php

namespace MediTrack\Microservices\Auth;

require_once __DIR__ . '/../Common/Infrastructure.php';

use MediTrack\Microservices\Common\ServiceDatabase;

class AuthService {
    private $db;

    public function __construct() {
        $this->db = new ServiceDatabase('AuthDB');
    }

    public function authenticate($user, $pass) {
        echo "[AuthService] Authenticating user '$user' with Role 'Patient'\n";
        return ['user' => $user, 'role' => 'Patient'];
    }

    public function register($userData) {
        echo "[AuthService] REGISTER: Mendaftarkan pasien baru " . $userData['name'] . "\n";
        return $this->db->insert($userData);
    }

    public function logout() {
        echo "[AuthService] LOGOUT: Sesi diakhiri.\n";
        return true;
    }
}

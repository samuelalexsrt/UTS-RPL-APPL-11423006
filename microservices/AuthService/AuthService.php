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
        echo "[AuthService] Authenticating user '$user'\n";
        return true;
    }
}

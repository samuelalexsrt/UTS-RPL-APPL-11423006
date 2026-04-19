<?php

namespace MediTrack\Monolith\Modules;

use MediTrack\Monolith\Database;

class Auth {
    public function login($username, $password) {
        echo "[Auth] User '$username' logged in.\n";
        return true;
    }
}

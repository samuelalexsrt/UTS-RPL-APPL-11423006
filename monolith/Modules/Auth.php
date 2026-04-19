<?php

namespace MediTrack\Monolith\Modules;

use MediTrack\Monolith\Database;

class Auth {
    public function login($username, $password) {
        echo "[Auth] User '$username' logged in as 'Patient'.\n";
        return ['username' => $username, 'role' => 'Patient', 'status' => 'logged_in'];
    }

    public function register($userData) {
        echo "[Auth] Mendaftarkan pasien baru: " . $userData['name'] . "\n";
        return true;
    }

    public function logout() {
        echo "[Auth] User logged out.\n";
        return true;
    }
}

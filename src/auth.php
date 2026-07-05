<?php

require_once __DIR__ . '/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $authKey = $_POST['auth_key'] ?? '';

    // 1. Proper character length validation (not byte-length)
    if (mb_strlen($authKey, 'UTF-8') > 256) {
        die("Invalid input length.");
    }

    // 2. Example stored hash (Argon2id)
    // In real system, this comes from database
    $storedHash = password_hash("test123", PASSWORD_ARGON2ID);

    // 3. Secure verification
    if (password_verify($authKey, $storedHash)) {
        echo "Access Granted";
    } else {
        echo "Access Denied";
    }
}
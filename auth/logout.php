<?php
session_start();

// Destroy all session data
$_SESSION = [];
session_destroy();

// If AJAX, return JSON
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}

// Otherwise, redirect to login
require_once __DIR__ . '/../config/config.php';
header("Location: $base_url/auth/login.php");
exit;

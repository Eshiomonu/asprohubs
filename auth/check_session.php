<?php
session_start();
header('Content-Type: application/json');

$response = [
    'logged_in' => false,
    'user' => null
];

if (isset($_SESSION['user'])) {
    $response['logged_in'] = true;
    $response['user'] = [
        'id' => $_SESSION['user']['id'],
        'name' => $_SESSION['user']['name'],
        'email' => $_SESSION['user']['email'],
        'avatar' => $_SESSION['user']['avatar'],
        'role' => $_SESSION['user']['role'] ?? 'student'
    ];
}

echo json_encode($response);

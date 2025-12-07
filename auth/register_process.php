<?php
require_once __DIR__ . '/../config/config.php';
session_start();

$fullname = trim($_POST['fullname']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (!$fullname || !$email || !$password || !$confirm_password) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: register.php");
    exit;
}

if ($password !== $confirm_password) {
    $_SESSION['error'] = "Passwords do not match.";
    header("Location: register.php");
    exit;
}

// Check if email exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
$stmt->bindValue(':email', $email);
$stmt->execute();
if ($stmt->fetch()) {
    $_SESSION['error'] = "Email already registered.";
    header("Location: register.php");
    exit;
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$stmt = $conn->prepare("
    INSERT INTO users (fullname, email, password, role_id, created_at) 
    VALUES (:fullname, :email, :password, 2, NOW())
");
$stmt->bindValue(':fullname', $fullname);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $hashed_password);

if ($stmt->execute()) {
    $_SESSION['user_id'] = $conn->lastInsertId();
    $_SESSION['fullname'] = $fullname;
    header("Location: ../dashboard/index.php");
} else {
    $_SESSION['error'] = "Registration failed.";
    header("Location: register.php");
}

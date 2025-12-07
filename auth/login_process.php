<?php
session_start();

require_once __DIR__ . '/../config/config.php'; // BASE_URL
// require_once __DIR__ . '/../config/db.php';     // PDO connection $conn

// Redirect if request is not POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/auth/login.php');
    exit;
}

// Get inputs
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Validate
if (!$email || !$password) {
    $_SESSION['login_error'] = 'Email and password are required.';
    header('Location: ' . BASE_URL . '/auth/login.php');
    exit;
}

try {
    // Fetch user
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['login_error'] = 'No account found with this email.';
        header('Location: ' . BASE_URL . '/auth/login.php');
        exit;
    }

    // Verify password
    if (!password_verify($password, $user['password'])) {
        $_SESSION['login_error'] = 'Incorrect password.';
        header('Location: ' . BASE_URL . '/auth/login.php');
        exit;
    }

    // Store user session
    $_SESSION['user'] = [
        'id'     => $user['id'],
        'name'   => $user['name'],
        'email'  => $user['email'],
        'avatar' => $user['avatar'] ?? '/assets/images/default-user.png',
        'role'   => $user['role'] ?? 'student'
    ];

    // Redirect to dashboard
    header('Location: ' . BASE_URL . '/dashboard/index.php');
    exit;

} catch (PDOException $e) {
    // Handle errors
    $_SESSION['login_error'] = 'An unexpected error occurred. Please try again.';
    header('Location: ' . BASE_URL . '/auth/login.php');
    exit;
}

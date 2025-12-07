<?php
session_start();
require_once __DIR__ . '/../config/config.php';

$pageTitle = "Admin Login";

// If already logged in → redirect
if (!empty($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $error = "All fields are required.";
    } else {

        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {

            $_SESSION['admin_id']   = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];

            header("Location: /admin/dashboard.php");
            exit;

        } else {
            $error = "Invalid login credentials.";
        }
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">

        <h4 class="text-center mb-4 fw-bold">Admin Login</h4>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Login</button>
        </form>

    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

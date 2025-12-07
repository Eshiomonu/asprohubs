<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include config for BASE_URL
require_once __DIR__ . '/../config/config.php';

// Active page helper
if (!function_exists('isActive')) {
    function isActive($page) {
        $current_page = basename($_SERVER['PHP_SELF']);
        return $current_page === $page ? "active" : "";
    }
}

// Get current user info
$user_logged_in = isset($_SESSION['user']);
$user = $user_logged_in ? $_SESSION['user'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="AsproHubs LMS - Professional training and e-learning platform." />
    <meta name="keywords" content="AsproHubs, LMS, e-learning, training, courses, education" />
    <meta name="author" content="AsproHubs" />
    <meta property="og:title" content="AsproHubs LMS" />
    <meta property="og:description" content="Professional corporate courses to help you grow." />
    <meta property="og:image" content="<?php echo BASE_URL; ?>/assets/images/og-image.jpg" />
    <meta property="og:type" content="website" />

    <title>AsproHubs - Empower Your Learning</title>
    <link rel="icon" href="<?php echo BASE_URL; ?>/assets/images/favicon.png" />

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css" />
</head>
<body class="aspro-light">

<!-- ======== NAVBAR ======== -->
<nav class="navbar navbar-expand-lg navbar-aspro sticky-top shadow-sm">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="<?php echo BASE_URL; ?>/index.php">
            <img src="<?php echo BASE_URL; ?>/assets/images/logo.png" alt="AsproHubs Logo" height="42">
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#asproNav">
            <i class="bi bi-list fs-1"></i>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="asproNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('index.php'); ?>" href="<?php echo BASE_URL; ?>/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('about.php'); ?>" href="<?php echo BASE_URL; ?>/about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('courses.php'); ?>" href="<?php echo BASE_URL; ?>/courses.php">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('contact.php'); ?>" href="<?php echo BASE_URL; ?>/contact.php">Contact</a>
                </li>
            </ul>

            <!-- Right Side -->
            <div class="d-flex align-items-center ms-lg-3 mt-3 mt-lg-0 gap-3">

                <!-- Light/Dark Toggle -->
                <button id="themeToggle" class="btn btn-light d-flex align-items-center">
                    <i class="bi bi-moon-stars fs-5"></i>
                </button>

                <!-- Sign In Button -->
                <a href="<?php echo BASE_URL; ?>/auth/login.php" class="btn btn-aspro" id="signinBtn" <?php echo $user_logged_in ? 'style="display:none;"' : ''; ?>>Sign In</a>

                <!-- User Dropdown -->
                <div class="dropdown <?php echo $user_logged_in ? '' : 'd-none'; ?>" id="userDropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <img src="<?php echo BASE_URL . ($user['avatar'] ?? '/assets/images/default-user.png'); ?>" class="rounded-circle" width="32" height="32" id="userAvatar" alt="User Avatar">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>/dashboard/index.php">Dashboard</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>/dashboard/profile.php">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?php echo BASE_URL; ?>/auth/logout.php" id="logoutBtn">Logout</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</nav>

<!-- ======== JS for SPA-like Navbar ======== -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const signinBtn = document.getElementById('signinBtn');
    const userDropdown = document.getElementById('userDropdown');
    const userAvatar = document.getElementById('userAvatar');
    const logoutBtn = document.getElementById('logoutBtn');

    // Function to check session
    function checkSession() {
        fetch('<?php echo BASE_URL; ?>/auth/check_session.php')
            .then(res => res.json())
            .then(data => {
                if (data.logged_in) {
                    signinBtn.style.display = 'none';
                    userDropdown.classList.remove('d-none');
                    userAvatar.src = '<?php echo BASE_URL; ?>' + data.user.avatar;
                } else {
                    signinBtn.style.display = 'block';
                    userDropdown.classList.add('d-none');
                }
            });
    }

    // Initial check
    checkSession();

    // Poll session every 30s
    setInterval(checkSession, 30000);

    // Handle logout without reload
    logoutBtn?.addEventListener('click', function(e) {
        e.preventDefault();
        fetch('<?php echo BASE_URL; ?>/auth/logout.php')
            .then(() => checkSession());
    });
});
</script>

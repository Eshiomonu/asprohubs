<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Detect active page
$current_page = basename($_SERVER['PHP_SELF']);

function isActive($page) {
    global $current_page;
    return $current_page === $page ? "active" : "";
}
?>

<nav class="navbar navbar-expand-lg navbar-aspro shadow-sm">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="/assets/images/logo.png" alt="AsproHubs" height="40" class="me-2">
        </a>

        <!-- MOBILE TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#asproNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAV LINKS -->
        <div class="collapse navbar-collapse" id="asproNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('index.php'); ?>" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('about.php'); ?>" href="about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('courses.php'); ?>" href="courses.php">Courses</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('contact.php'); ?>" href="contact.php">Contact</a>
                </li>

            </ul>

            <!-- RIGHT SIDE BUTTONS -->
            <div class="ms-3">

                <?php if (isset($_SESSION['user'])): ?>
                    
                    <!-- USER DROPDOWN -->
                    <div class="dropdown d-inline">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <img src="<?php echo $_SESSION['user']['avatar'] ?? '/assets/images/default-user.png'; ?>" 
                                 class="rounded-circle me-2" 
                                 width="32" height="32" />
                            <?php echo $_SESSION['user']['name']; ?>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        </ul>
                    </div>

                <?php else: ?>

                    <!-- SIGN IN BUTTON -->
                    <a href="login.php" class="btn btn-aspro">Sign In</a>

                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>

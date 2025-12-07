<?php
// Sidebar links
$sidebarLinks = [
    ['title' => 'Dashboard', 'icon' => 'bi-speedometer2', 'href' => 'dashboard.php'],
    ['title' => 'Users', 'icon' => 'bi-people', 'href' => 'users.php'],
    ['title' => 'Courses', 'icon' => 'bi-journal-bookmark', 'href' => 'courses.php'],
    ['title' => 'Settings', 'icon' => 'bi-gear', 'href' => 'settings.php'],
    ['title' => 'Logout', 'icon' => 'bi-box-arrow-right', 'href' => 'logout.php'],
];
?>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-light vh-100" style="width: 250px;">
    <a href="dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <i class="bi bi-mortarboard-fill fs-3 text-primary me-2"></i>
        <span class="fs-5 fw-bold">ASPRO Admin</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <?php foreach($sidebarLinks as $link): ?>
            <li class="nav-item mb-1">
                <a href="<?= $link['href'] ?>" class="nav-link text-dark <?= basename($_SERVER['PHP_SELF']) == $link['href'] ? 'active' : '' ?>">
                    <i class="bi <?= $link['icon'] ?> me-2"></i> <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

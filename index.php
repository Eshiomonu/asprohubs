<?php
$pageTitle = "Home";
$activePage = "home";
$isAuthenticated = false; // or from session
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<!-- Hero Section -->
<?php include __DIR__ . '/sections/hero.php'; ?>
<?php include __DIR__ . '/sections/featured-courses.php'; ?>

<!-- Other homepage sections can follow here -->

<?php include __DIR__ . '/includes/footer.php'; ?>

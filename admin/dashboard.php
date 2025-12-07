<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = "Admin Dashboard";
include __DIR__ . '/includes/header.php';
?>

<div class="d-flex">
    <!-- Sidebar -->
    <?php include __DIR__ . '/includes/sidebar.php'; ?>

    <!-- Main content -->
    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Dashboard</h2>

        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm text-white bg-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title">Courses</h5>
                                <h3>12</h3>
                            </div>
                            <i class="bi bi-journal-bookmark fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm text-white bg-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title">Users</h5>
                                <h3>245</h3>
                            </div>
                            <i class="bi bi-people fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm text-white bg-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title">Active Students</h5>
                                <h3>180</h3>
                            </div>
                            <i class="bi bi-person-check fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm text-white bg-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title">Revenue</h5>
                                <h3>$5,240</h3>
                            </div>
                            <i class="bi bi-currency-dollar fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional dashboard sections -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">Recent Activities</h5>
                <p class="text-muted">You can show recent admin actions, course creations, user registrations, etc. here.</p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

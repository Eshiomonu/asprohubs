<?php
require_once __DIR__ . '/../config/config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: $base_url/auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$stmt = $conn->prepare("SELECT fullname, email, created_at FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch enrolled courses
$stmt = $conn->prepare("
    SELECT c.id, c.title, c.duration, c.price, c.excerpt
    FROM enrollments e
    JOIN courses c ON e.course_id = c.id
    WHERE e.user_id = :user_id
    ORDER BY e.enrolled_at DESC
");
$stmt->execute(['user_id' => $user_id]);
$enrolled_courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total spent
$total_spent = 0;
foreach ($enrolled_courses as $c) {
    $total_spent += $c['price'];
}

include __DIR__ . '/../includes/header.php';
?>

<section class="container py-5">
    <div class="row">

        <!-- Profile Info -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm p-3">
                <h4 class="fw-bold">Profile</h4>
                <p><strong>Name:</strong> <?= htmlspecialchars($user['fullname']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <!-- <p><strong>Member Since:</strong> <?= date('M d, Y', strtotime($user['created_at'])) ?></p> -->
                <a href="<?= $base_url ?>/auth/logout.php" class="btn btn-danger w-100 mt-3">Logout</a>
            </div>

            <div class="card shadow-sm p-3 mt-4">
                <h4 class="fw-bold">Summary</h4>
                <p><strong>Total Courses:</strong> <?= count($enrolled_courses) ?></p>
                <p><strong>Total Spent:</strong> $<?= number_format($total_spent,2) ?></p>
            </div>
        </div>

        <!-- Enrolled Courses -->
        <div class="col-lg-8">
            <h4 class="fw-bold mb-3">My Courses</h4>

            <?php if(empty($enrolled_courses)): ?>
                <div class="alert alert-info">You have not enrolled in any courses yet.</div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach($enrolled_courses as $course): ?>
                        <div class="col-md-6">
                            <div class="card shadow-sm h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                                    <p class="text-muted"><?= htmlspecialchars($course['excerpt']) ?></p>
                                    <p class="mb-1"><strong>Duration:</strong> <?= htmlspecialchars($course['duration']) ?></p>
                                    <p><strong>Price:</strong> $<?= number_format($course['price'],2) ?></p>
                                    <a href="<?= $base_url ?>/course.php?id=<?= $course['id'] ?>" class="btn btn-primary mt-auto">View Course</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>

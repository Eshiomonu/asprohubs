<?php
require_once __DIR__ . '/config/config.php';
$pageTitle = "Courses";
$activePage = "COURSES";

// Pagination & filter
$limit = 6;
$page  = max(1, intval($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

// Search & Category filter
$search   = trim($_GET['search'] ?? '');
$category = trim($_GET['category'] ?? '');

// Build WHERE clause
$where = [];
$params = [];

if ($search !== '') {
    $where[] = "title LIKE :search";
    $params['search'] = "%$search%";
}

if ($category !== '') {
    $where[] = "category = :category";
    $params['category'] = $category;
}

$whereSql = $where ? "WHERE " . implode(' AND ', $where) : "";

// Count total courses
$totalCourses = $conn->prepare("SELECT COUNT(*) FROM courses $whereSql");
$totalCourses->execute($params);
$total = $totalCourses->fetchColumn();
$totalPages = ceil($total / $limit);

// Fetch courses for current page
$stmt = $conn->prepare("SELECT * FROM courses $whereSql ORDER BY created_at DESC LIMIT :offset, :limit");
foreach ($params as $k => $v) $stmt->bindValue(":$k", $v);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch distinct categories for filter
$categories = $conn->query("SELECT DISTINCT category FROM courses ORDER BY category ASC")->fetchAll(PDO::FETCH_COLUMN);

include __DIR__ . '/includes/header.php';
?>

<!-- HERO SECTION -->
<section class="py-5 courses-page-card text-white text-center">
    <div class="container">
        <h1 class="display-4 fw-bold"><?= $pageTitle ?></h1>
        <p class="lead mt-2">Explore our wide range of professional courses designed to boost your skills and career.</p>
    </div>
</section>

<!-- FILTER & SEARCH -->
<section class="container py-5">
    <form method="GET" class="row g-3 mb-5 align-items-end">
        <div class="col-md-4">
            <label class="form-label fw-semibold">Search Courses</label>
            <input type="text" class="form-control rounded-pill" name="search" placeholder="Enter course title..." value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Category</label>
            <select name="category" class="form-select rounded-pill">
                <option value="">All Categories</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat) ?>" <?= $cat==$category?'selected':'' ?>><?= htmlspecialchars($cat) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-aspro w-100">Filter</button>
        </div>
    </form>

    <!-- COURSES GRID -->
   <!-- COURSES GRID -->
<div class="row g-4">
    <?php foreach($courses as $course): ?>
        <div class="col-md-4 col-lg-4">
            <div class="card course-card shadow-sm h-100">

                <!-- Featured Image -->
                <img src="<?= $course['card_image'] ? BASE_URL . $course['card_image'] : BASE_URL . '/assets/images/hero-default.jpg' ?>"
                     class="card-img-top"
                     alt="<?= htmlspecialchars($course['title']) ?>">

                <div class="card-body d-flex flex-column">

                    <!-- Category Badge -->
                    <span class="badge bg-primary mb-2">
                        <?= htmlspecialchars($course['category']) ?>
                    </span>

                    <!-- Title -->
                    <h5 class="card-title fw-semibold">
                        <?= htmlspecialchars($course['title']) ?>
                    </h5>

                    <!-- Rating (fallback if none) -->
                    <div class="rating mb-2">
                        <span class="text-warning">★★★★☆</span>
                        <small class="text-muted ms-1">(4.5)</small>
                    </div>

                    <!-- Description -->
                    <p class="card-text text-muted">
                        <?= htmlspecialchars($course['excerpt']) ?>
                    </p>

                    <!-- Duration & Students -->
                    <div class="d-flex justify-content-between text-muted small mb-3">
                        <span><i class="bi bi-clock"></i> <?= htmlspecialchars($course['duration']) ?></span>
                        <span><i class="bi bi-people"></i> <?= number_format($course['students'] ?? 0) ?> students</span>
                    </div>

                    <!-- Price + Button -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-auto">
                        <span class="fw-bold text-success fs-5">$<?= number_format($course['price'], 2) ?></span>
                        <a href="<?= BASE_URL ?>/course.php?id=<?= $course['id'] ?>" class="btn btn-primary btn-sm">
                            View Details
                        </a>
                    </div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


    <!-- PAGINATION -->
    <?php if($totalPages>1): ?>
    <nav class="mt-5">
        <ul class="pagination justify-content-center">
            <?php for($i=1;$i<=$totalPages;$i++): ?>
                <li class="page-item <?= $i==$page?'active':'' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>

</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

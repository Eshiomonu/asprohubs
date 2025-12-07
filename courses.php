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
<section class="py-5 bg-primary text-white text-center">
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
    <div class="row g-4">
        <?php foreach($courses as $course): ?>
            <div class="col-md-4">
                <div class="card course-card h-100 shadow-sm hover-scale border-0">
                    <img src="<?= $course['card_image'] ? BASE_URL . $course['card_image'] : BASE_URL . '/assets/images/hero-default.jpg' ?>" 
                         class="card-img-top" alt="<?= htmlspecialchars($course['title']) ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="course-title"><?= htmlspecialchars($course['title']) ?></h5>
                        <p class="text-muted mb-2"><?= htmlspecialchars($course['excerpt']) ?></p>
                        <p class="mb-1"><strong>Duration:</strong> <?= htmlspecialchars($course['duration']) ?></p>
                        <p class="mb-3"><strong>Price:</strong> $<?= number_format($course['price'],2) ?></p>
                        <a href="<?= BASE_URL ?>/course.php?id=<?= $course['id'] ?>" class="btn btn-aspro mt-auto">Learn More</a>
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

<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config/config.php';

$pageTitle = "Manage Courses";
$success = $error = "";

// Handle Create/Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id           = $_POST['course_id'] ?? null;
    $title        = trim($_POST['title']);
    $excerpt      = trim($_POST['excerpt']);
    $full_desc    = trim($_POST['full_description']);
    $duration     = trim($_POST['duration']);
    $course_type  = $_POST['course_type'];
    $location     = $course_type === 'offline' ? trim($_POST['location'] ?? '') : null;
    $is_self_paced= $course_type === 'online' ? ($_POST['is_self_paced'] ?? 1) : null;
    $meeting_link = $course_type === 'online' && !$is_self_paced ? trim($_POST['meeting_link'] ?? '') : null;
    $price        = trim($_POST['price']);
    $category     = trim($_POST['category']);
    $curriculum   = null;
    $hero_image   = null;
    $card_image   = null;

    // Upload images & files
    $uploadDir = __DIR__ . '/../assets/uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    if (!empty($_FILES['hero_image']['name'])) {
        $ext = pathinfo($_FILES['hero_image']['name'], PATHINFO_EXTENSION);
        $hero_image = '/assets/uploads/' . uniqid('hero_') . '.' . $ext;
        move_uploaded_file($_FILES['hero_image']['tmp_name'], __DIR__ . '/../' . $hero_image);
    }

    if (!empty($_FILES['card_image']['name'])) {
        $ext = pathinfo($_FILES['card_image']['name'], PATHINFO_EXTENSION);
        $card_image = '/assets/uploads/' . uniqid('card_') . '.' . $ext;
        move_uploaded_file($_FILES['card_image']['tmp_name'], __DIR__ . '/../' . $card_image);
    }

    if (!empty($_FILES['curriculum']['name'])) {
        $ext = pathinfo($_FILES['curriculum']['name'], PATHINFO_EXTENSION);
        $curriculum = '/assets/uploads/' . uniqid('curr_') . '.' . $ext;
        move_uploaded_file($_FILES['curriculum']['tmp_name'], __DIR__ . '/../' . $curriculum);
    }

    if ($id) {
        // Update existing course
        $stmt = $conn->prepare("UPDATE courses SET title=:title, excerpt=:excerpt, full_description=:full_description,
                                duration=:duration, course_type=:course_type, location=:location, is_self_paced=:is_self_paced,
                                meeting_link=:meeting_link, price=:price, category=:category, curriculum=:curriculum,
                                hero_image=:hero_image, card_image=:card_image WHERE id=:id");
        $stmt->execute([
            'title'=>$title, 'excerpt'=>$excerpt, 'full_description'=>$full_desc, 'duration'=>$duration,
            'course_type'=>$course_type, 'location'=>$location, 'is_self_paced'=>$is_self_paced,
            'meeting_link'=>$meeting_link, 'price'=>$price, 'category'=>$category, 'curriculum'=>$curriculum,
            'hero_image'=>$hero_image, 'card_image'=>$card_image, 'id'=>$id
        ]);
        $success = "Course updated successfully!";
    } else {
        // Insert new course
        $stmt = $conn->prepare("INSERT INTO courses (title, excerpt, full_description, duration, course_type, location, is_self_paced, meeting_link, price, category, curriculum, hero_image, card_image)
                                VALUES (:title, :excerpt, :full_description, :duration, :course_type, :location, :is_self_paced, :meeting_link, :price, :category, :curriculum, :hero_image, :card_image)");
        $stmt->execute([
            'title'=>$title, 'excerpt'=>$excerpt, 'full_description'=>$full_desc, 'duration'=>$duration,
            'course_type'=>$course_type, 'location'=>$location, 'is_self_paced'=>$is_self_paced,
            'meeting_link'=>$meeting_link, 'price'=>$price, 'category'=>$category, 'curriculum'=>$curriculum,
            'hero_image'=>$hero_image, 'card_image'=>$card_image
        ]);
        $success = "Course created successfully!";
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM courses WHERE id=:id");
    $stmt->execute(['id'=>$_GET['delete']]);
    $success = "Course deleted successfully!";
}

// Fetch all courses
$courses = $conn->query("SELECT * FROM courses ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<div class="d-flex">
    <?php include __DIR__ . '/includes/sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
        <h2 class="mb-4">Manage Courses</h2>

        <?php if($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

        <!-- Button trigger modal -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#courseModal">
            Add New Course
        </button>

        <!-- Courses Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($courses as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c['title']) ?></td>
                            <td><?= htmlspecialchars($c['category']) ?></td>
                            <td><?= htmlspecialchars($c['course_type']) ?></td>
                            <td><?= htmlspecialchars($c['duration']) ?></td>
                            <td>$<?= number_format($c['price'],2) ?></td>
                            <td>
                                <a href="?edit=<?= $c['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="?delete=<?= $c['id'] ?>" onclick="return confirm('Delete course?');" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Course Modal -->
        <div class="modal fade" id="courseModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Add / Edit Course</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="course_id" id="course_id">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Excerpt</label>
                                <textarea class="form-control" name="excerpt" id="excerpt" rows="2"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Full Description</label>
                                <textarea class="form-control" name="full_description" id="full_description" rows="4" required></textarea>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Duration</label>
                                    <input type="text" class="form-control" name="duration" id="duration" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Price ($)</label>
                                    <input type="number" class="form-control" name="price" id="price" step="0.01" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Category</label>
                                    <input type="text" class="form-control" name="category" id="category" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course Type</label>
                                <select class="form-select" name="course_type" id="course_type" onchange="toggleTypeFields()">
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>
                            <div class="mb-3" id="locationField">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" id="location">
                            </div>
                            <div class="mb-3" id="selfPacedField">
                                <label class="form-label">Self-paced?</label>
                                <select class="form-select" name="is_self_paced" id="is_self_paced" onchange="toggleMeetingField()">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="mb-3" id="meetingField">
                                <label class="form-label">Meeting Link</label>
                                <input type="text" class="form-control" name="meeting_link" id="meeting_link">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hero Image</label>
                                <input type="file" class="form-control" name="hero_image">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Card Image</label>
                                <input type="file" class="form-control" name="card_image">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Curriculum (PDF)</label>
                                <input type="file" class="form-control" name="curriculum" accept=".pdf">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function toggleTypeFields(){
    const type = document.getElementById('course_type').value;
    document.getElementById('locationField').style.display = type === 'offline' ? 'block' : 'none';
    document.getElementById('selfPacedField').style.display = type === 'online' ? 'block' : 'none';
    toggleMeetingField();
}

function toggleMeetingField(){
    const isSelf = document.getElementById('is_self_paced').value;
    const type = document.getElementById('course_type').value;
    document.getElementById('meetingField').style.display = (type === 'online' && isSelf === '0') ? 'block' : 'none';
}

// Initialize visibility
toggleTypeFields();
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>

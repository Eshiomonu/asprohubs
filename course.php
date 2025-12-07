<?php
require_once __DIR__ . "/config/config.php";

// Validate course ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<h3 class='text-center mt-5'>Invalid Course</h3>";
    exit;
}

$course_id = intval($_GET['id']);

// Fetch course
$stmt = $conn->prepare("SELECT * FROM courses WHERE id = :id");
$stmt->bindValue(':id', $course_id, PDO::PARAM_INT);
$stmt->execute();
$course = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$course) {
    echo "<h3 class='text-center mt-5'>Course not found</h3>";
    exit;
}

include __DIR__ . "/includes/header.php";
?>

<!-- HERO SECTION -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left: Course Info -->
            <div class="col-lg-6 mb-4">
                <h1 class="display-5 fw-bold"><?= htmlspecialchars($course['title']) ?></h1>
                <p class="lead"><?= htmlspecialchars($course['excerpt']) ?></p>

                <div class="d-flex gap-3 mt-3 flex-wrap">
                    <span><i class="bi bi-clock"></i> <?= htmlspecialchars($course['duration']) ?></span>
                    <span><i class="bi bi-play-circle"></i> <?= ucfirst(htmlspecialchars($course['type'])) ?></span>
                    <span><i class="bi bi-currency-dollar"></i> <?= number_format($course['price'], 2) ?></span>
                </div>

                <button class="btn btn-light btn-lg mt-4 hover-scale" 
                        data-bs-toggle="modal" 
                        data-bs-target="#checkoutModal">
                    Enroll Now
                </button>
            </div>

            <!-- Right: Hero Image -->
            <div class="col-lg-6">
                <img src="<?= $course['hero_image'] ? BASE_URL . '/uploads/hero/' . $course['hero_image'] : BASE_URL . '/assets/images/hero-default.jpg' ?>" 
                     class="img-fluid rounded shadow" 
                     alt="<?= htmlspecialchars($course['title']) ?>">
            </div>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="container my-5">
    <div class="row">

        <!-- LEFT CONTENT -->
        <div class="col-lg-8">

            <!-- DESCRIPTION -->
            <div class="card shadow-sm mb-4 rounded-4">
                <div class="card-header bg-white">
                    <h4 class="fw-bold">Course Description</h4>
                </div>
                <div class="card-body">
                    <?= nl2br(htmlspecialchars($course['full_description'])) ?>
                </div>
            </div>

            <!-- CURRICULUM -->
            <div class="card shadow-sm mb-4 rounded-4">
                <div class="card-header bg-white">
                    <h4 class="fw-bold">Curriculum</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($course['curriculum_file'])): ?>
                        <a href="<?= BASE_URL ?>/uploads/curriculum/<?= $course['curriculum_file'] ?>" 
                           class="btn btn-outline-primary rounded-pill hover-scale" 
                           download>
                           <i class="bi bi-file-earmark-pdf"></i> Download Curriculum
                        </a>
                    <?php else: ?>
                        <p>No curriculum uploaded.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- LOCATION OR LIVE TRAINING -->
            <?php if ($course['type'] === 'onsite'): ?>
            <div class="card shadow-sm mb-4 rounded-4">
                <div class="card-header bg-white">
                    <h4 class="fw-bold">Training Location</h4>
                </div>
                <div class="card-body">
                    <p><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($course['location']) ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($course['type'] === 'online' && $course['online_type'] === 'live'): ?>
            <div class="card shadow-sm mb-4 rounded-4">
                <div class="card-header bg-white">
                    <h4 class="fw-bold">Live Training Link</h4>
                </div>
                <div class="card-body">
                    <p>Meeting Link:  
                       <a href="<?= htmlspecialchars($course['meeting_link']) ?>" target="_blank" class="text-decoration-none">
                           Join Live Class
                       </a>
                    </p>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="col-lg-4">
            <div class="card sticky-top shadow-sm rounded-4" style="top: 100px;">
                <div class="card-body text-center">
                    <h3 class="fw-bold mb-3">$<?= number_format($course['price'], 2) ?></h3>
                    <button class="btn btn-aspro btn-lg w-100 mb-3 hover-scale" 
                            data-bs-toggle="modal" 
                            data-bs-target="#checkoutModal">
                        Enroll Now
                    </button>
                    <hr>

                    <ul class="list-unstyled text-start">
                        <li><i class="bi bi-check-circle text-success me-2"></i> Lifetime Access</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Certificate Included</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> 24/7 Support</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Downloadable Materials</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- CHECKOUT MODAL -->
<div class="modal fade" id="checkoutModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <?php if (!isset($_SESSION['user_id'])): ?>
          <div class="modal-body text-center p-5">
              <h4>You must be logged in to continue</h4>
              <a href="<?= BASE_URL ?>/auth/register.php" class="btn btn-aspro mt-3 hover-scale">Create Account</a>
              <a href="<?= BASE_URL ?>/auth/login.php" class="btn btn-secondary mt-2 hover-scale">Login</a>
          </div>
      <?php else: ?>
          <div class="modal-header">
              <h5 class="modal-title">Checkout</h5>
          </div>
          <div class="modal-body">
              <p>You are about to enroll into:</p>
              <h4><?= htmlspecialchars($course['title']) ?></h4>
              <p class="fw-bold">Price: $<?= number_format($course['price'], 2) ?></p>
          </div>
          <div class="modal-footer">
              <a href="<?= BASE_URL ?>/process-enrollment.php?course_id=<?= $course['id'] ?>" 
                 class="btn btn-aspro hover-scale">
                 Proceed to Payment
              </a>
          </div>
      <?php endif; ?>

    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

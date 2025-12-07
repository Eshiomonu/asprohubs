<?php include __DIR__ . "/includes/header.php"; ?>

<?php
// Stats
$stats = [
    ["icon" => "bi-people", "value" => "15,000+", "label" => "Active Students"],
    ["icon" => "bi-award", "value" => "98%", "label" => "Pass Rate"],
    ["icon" => "bi-book", "value" => "50+", "label" => "Expert Instructors"],
    ["icon" => "bi-graph-up-arrow", "value" => "95%", "label" => "Satisfaction Rate"],
];

// Core Values
$values = [
    [
        "icon" => "bi-bullseye",
        "title" => "Excellence in Education",
        "description" => "We provide top-tier professional training aligned with global standards."
    ],
    [
        "icon" => "bi-shield-check",
        "title" => "Proven Track Record",
        "description" => "Thousands of successful professionals trust our certification programs."
    ],
    [
        "icon" => "bi-people",
        "title" => "Student-Centered Approach",
        "description" => "We ensure flexible learning and strong academic support for all students."
    ],
];

// Certifications
$certs = ["PMP","CBAP","ITIL","RMP","PSM","Data Analysis","MS Project","Primavera P6"];
?>

<!-- HERO SECTION -->
<section class="py-5 text-white" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?php echo BASE_URL; ?>/assets/images/hero.jpg') center/cover no-repeat;">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">About ASPRO Business Solutions</h1>
        <p class="lead mx-auto mt-3" style="max-width: 700px;">
            Your trusted partner in professional certification and career advancement.
        </p>
        <a href="<?php echo BASE_URL; ?>/courses.php" class="btn btn-aspro btn-lg mt-3">Explore Courses</a>
    </div>
</section>

<!-- ABOUT BRIEF SECTION -->
<section class="container py-5">
    <div class="row align-items-center g-4">
        
        <!-- LEFT IMAGE -->
        <div class="col-lg-6">
            <img src="<?php echo BASE_URL; ?>/assets/images/power.webp" 
                 alt="About AsproHubs" class="img-fluid rounded shadow">
        </div>
        
        <!-- RIGHT TEXT -->
        <div class="col-lg-6">
            <h2 class="fw-bold mb-3">Who We Are</h2>
            <h5 class="text-primary mb-3">Professional Training. Corporate Excellence.</h5>
            <p class="text-muted mb-4">
                At AsproHubs, we empower professionals with cutting-edge skills and globally recognized certifications. 
                Our mission is to provide flexible, high-quality learning solutions that accelerate careers and drive organizational success.
            </p>
            <a href="<?php echo BASE_URL; ?>/courses.php" class="btn btn-aspro btn-lg">Explore Our Courses</a>
        </div>
        
    </div>
</section>


<!-- MISSION SECTION -->
<!-- MISSION & VISION SECTION -->
<section class="py-5" >
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Our Mission & Vision</h2>

        <div class="row g-4 justify-content-center">

            <!-- Mission Card -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4 text-center p-4 h-100">
                    <div class="mb-3 d-flex justify-content-center align-items-center rounded-circle bg-primary text-white" style="width: 60px; height: 60px;">
                        <i class="bi bi-bullseye fs-3"></i>
                    </div>
                    <h4 class="fw-bold mb-2 mt-3">Our Mission</h4>
                    <p class="text-muted">
                        We empower professionals with the skills and certifications needed to excel in today's competitive environment.
                        Our programs are flexible, accessible, and built around global best practices using modern learning technology.
                    </p>
                </div>
            </div>

            <!-- Vision Card -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4 text-center p-4 h-100">
                    <div class="mb-3 d-flex justify-content-center align-items-center rounded-circle bg-primary text-white" style="width: 60px; height: 60px;">
                        <i class="bi bi-eye fs-3"></i>
                    </div>
                    <h4 class="fw-bold mb-2 mt-3">Our Vision</h4>
                    <p class="text-muted">
                        To become the leading provider of professional certifications and corporate training, 
                        enabling individuals and organizations worldwide to achieve excellence and sustainable growth.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- STATS SECTION -->
<section class="py-5" style="background-color: var(--aspro-primary-light);">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">Our Impact</h2>
        <div class="row g-4 justify-content-center">
            <?php foreach ($stats as $s): ?>
                <div class="col-6 col-md-3">
                    <div class="card shadow-sm border-0 rounded-4 p-4 text-center hover-scale">
                        <div class="mb-3">
                            <i class="bi <?= $s['icon'] ?> fs-1 text-primary"></i>
                        </div>
                        <h3 class="fw-bold"><?= $s['value'] ?></h3>
                        <p class="text-muted"><?= $s['label'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- VALUES SECTION -->
<section class="container py-5">
    <h2 class="text-center fw-bold mb-5">Our Core Values</h2>
    <div class="row g-4">
        <?php foreach ($values as $v): ?>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 text-center p-4 hover-scale">
                    <div class="value-icon mx-auto mb-3 d-flex justify-content-center align-items-center rounded-circle bg-primary-light" style="width: 60px; height: 60px;">
                        <i class="bi <?= $v['icon'] ?> fs-3 text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-2"><?= $v['title'] ?></h4>
                    <p class="text-muted"><?= $v['description'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- CERTIFICATIONS SECTION -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Professional Certifications We Offer</h2>
        <p class="text-muted mb-5">
            Comprehensive training for globally recognized certifications.
        </p>

        <div class="row g-3 justify-content-center">
            <?php foreach ($certs as $c): ?>
                <div class="col-6 col-md-3">
                    <div class="cert-card shadow-sm border-0 rounded-pill py-3 fw-semibold text-primary">
                        <?= $c ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<?php include __DIR__ . "/includes/footer.php"; ?>

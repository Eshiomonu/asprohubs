<?php include __DIR__ . "/includes/header.php"; ?>

<?php
$contactInfo = [
    [
        "icon" => "bi-envelope",
        "title" => "Email",
        "content" => "info@asprobusiness.com",
        "link" => "mailto:info@asprobusiness.com"
    ],
    [
        "icon" => "bi-telephone",
        "title" => "Phone",
        "content" => "+1 (555) 123-4567",
        "link" => "tel:+15551234567"
    ],
    [
        "icon" => "bi-geo-alt",
        "title" => "Location",
        "content" => "123 Business Park, Suite 400, New York, NY 10001",
        "link" => null
    ],
    [
        "icon" => "bi-clock",
        "title" => "Business Hours",
        "content" => "Mon–Fri: 9:00 AM – 6:00 PM EST",
        "link" => null
    ],
];
?>

<!-- HERO SECTION -->

<section class="py-5 text-white" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?php echo BASE_URL; ?>/assets/images/hero.jpg') center/cover no-repeat;">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Get in Touch</h1>
        <p class="lead mx-auto mt-3" style="max-width: 700px;">
            Have questions? We're here to help you advance your career through professional certification.
        </p>
       
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="py-5 bg-light">
    <div class="container">

        <div class="row g-5">

            <!-- CONTACT FORM -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white text-center py-3">
                        <h4 class="fw-bold mb-1">Send us a Message</h4>
                        <small class="text-muted">We respond within 24 hours</small>
                    </div>

                    <div class="card-body">
                        <form id="contactForm" class="contact-form">

                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control rounded-pill" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-pill" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control rounded-pill" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control rounded-pill" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" rows="5" class="form-control rounded-3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-aspro w-100 fw-semibold">
                                Send Message
                            </button>

                        </form>
                    </div>
                </div>
            </div>

            <!-- CONTACT INFO & FAQ -->
            <div class="col-lg-6">

                <!-- CONTACT INFO CARD -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-white py-3">
                        <h4 class="fw-bold mb-0">Contact Information</h4>
                        <small class="text-muted">Reach out through any of these channels</small>
                    </div>

                    <div class="card-body">
                        <?php foreach ($contactInfo as $info): ?>
                            <div class="d-flex gap-3 mb-4 align-items-start">
                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                                     style="width: 50px; height: 50px;">
                                    <i class="bi <?= $info['icon'] ?> text-primary fs-4"></i>
                                </div>

                                <div>
                                    <h6 class="fw-semibold mb-1"><?= $info['title'] ?></h6>
                                    <?php if ($info["link"]): ?>
                                        <a href="<?= $info['link'] ?>" class="text-muted text-decoration-none">
                                            <?= $info['content'] ?>
                                        </a>
                                    <?php else: ?>
                                        <p class="text-muted mb-0"><?= $info['content'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- FAQ CARD -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white py-3">
                        <h4 class="fw-bold mb-0">Frequently Asked Questions</h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="fw-semibold">How do I enroll in a course?</h6>
                            <p class="text-muted small">
                                Browse the course catalog, choose a course, and click “Register Now”.  
                                You’ll need an account to access learning materials.
                            </p>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-semibold">What payment methods do you accept?</h6>
                            <p class="text-muted small">
                                We accept all major credit cards and process payments securely through Stripe.
                            </p>
                        </div>

                        <div>
                            <h6 class="fw-semibold">Do you offer corporate training?</h6>
                            <p class="text-muted small">
                                Yes — we provide fully customized training programs for organizations.  
                                Contact us to request a corporate package.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>




<?php include __DIR__ . '/includes/footer.php'; ?>
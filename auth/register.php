<?php include __DIR__ . '/../includes/header.php'; ?>

<section class="auth-section section-light">
    <div class="container">
        <div class="row g-0 auth-wrapper align-items-center">

            <!-- Left Column - Image -->
            <div class="col-lg-6 auth-image d-none d-lg-block">
                <img src="<?php echo BASE_URL; ?>/assets/images/register.jpg" 
                     alt="Register Illustration" class="img-fluid rounded shadow">
            </div>

            <!-- Right Column - Form -->
            <div class="col-lg-6 auth-form px-5 py-5">
                <h2 class="auth-title mb-4">Create Your Account</h2>
                <p class="auth-subtitle mb-4">Join AsproHubs and start learning today.</p>

                <form action="<?php echo BASE_URL; ?>/auth/register_process.php" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="fullname" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" required class="form-control">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" required class="form-control">
                    </div>

                    <button type="submit" class="btn btn-aspro w-100 mb-3">Create Account</button>

                    <button type="button" class="btn btn-outline-secondary w-100 mb-4 d-flex align-items-center justify-content-center gap-2">
                        <img src="<?php echo BASE_URL; ?>/assets/images/google-icon.png" alt="Google" width="20">
                        Register with Google
                    </button>

                    <p class="text-center mt-3">
                        Already have an account? 
                        <a href="<?php echo BASE_URL; ?>/auth/login.php">Log In</a>
                    </p>

                </form>
            </div>

        </div>
    </div>
</section>

<?php include "../includes/footer.php"; ?>
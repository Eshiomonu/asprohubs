<?php 
session_start();
require_once __DIR__ . '/../config/config.php';
include __DIR__ . '/../includes/header.php'; 
?>

<section class="auth-section section-light">
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <!-- LEFT IMAGE -->
            <div class="col-lg-6 d-none d-lg-block">
                <img src="<?php echo BASE_URL; ?>/assets/images/login.avif" 
                     alt="Login Illustration" class="img-fluid rounded shadow">
            </div>

            <!-- RIGHT FORM -->
            <div class="col-lg-5 col-md-8">
                <div class="auth-box p-5 rounded">

                    <h2 class="auth-title mb-4 text-center">Welcome Back</h2>
                    <p class="auth-subtitle mb-4 text-center">
                        Log in to your AsproHubs account
                    </p>

                    <?php if(isset($_SESSION['login_error'])): ?>
                        <div class="alert alert-danger">
                            <?php 
                                echo $_SESSION['login_error']; 
                                unset($_SESSION['login_error']); // clear after display
                            ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo BASE_URL; ?>/auth/login_process.php" method="POST">

                        <div class="mb-3">
                            <label class="auth-label">Email Address</label>
                            <input type="email" name="email" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" required class="form-control">
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <a href="<?php echo BASE_URL; ?>/auth/forgot-password.php">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-aspro w-100 mb-3">Login</button>

                        <button type="button" class="btn btn-outline-secondary w-100 mb-4 d-flex align-items-center justify-content-center gap-2">
                            <img src="<?php echo BASE_URL; ?>/assets/images/google-icon.png" alt="Google" width="20">
                            Continue with Google
                        </button>

                        <p class="text-center mt-3">
                            Don't have an account? 
                            <a href="<?php echo BASE_URL; ?>/auth/register.php">Register Now</a>
                        </p>

                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>

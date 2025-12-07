<footer class="aspro-footer pt-5 pb-4">
    <div class="container">

        <div class="row g-4">

            <!-- Brand / About Column -->
            <div class="col-lg-3 col-md-6">
                <img src="/assets/images/logo.png" alt="AsproHubs Logo" class="footer-logo mb-3">
                <p class="footer-desc">
                    AsproHubs is a professional learning platform for individuals and organizations. 
                    Learn, grow and build high-value skills with industry-grade courses.
                </p>

                <div class="social-icons mt-3">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="/about.php">About Us</a></li>
                    <li><a href="/courses.php">Courses</a></li>
                    <li><a href="/contact.php">Contact</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Support</h5>
                <ul class="footer-links">
                    <li><a href="/faq.php">FAQ</a></li>
                    <li><a href="/terms.php">Terms & Conditions</a></li>
                    <li><a href="/privacy.php">Privacy Policy</a></li>
                    <li><a href="/help.php">Help Center</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Join Our Newsletter</h5>
                <p class="footer-desc">Stay updated with new courses & learning opportunities.</p>

                <form action="/newsletter.php" method="POST" class="newsletter-form">
                    <div class="input-group">
                        <input type="email" name="email" required class="form-control" placeholder="Enter your email">
                        <button class="btn btn-aspro" type="submit">Subscribe</button>
                    </div>
                </form>
            </div>

        </div>

        <hr class="footer-divider mt-5 mb-3">

        <div class="text-center">
            <p class="mb-0">
                © <?php echo date("Y"); ?> AsproHubs. All Rights Reserved.
            </p>
        </div>
    </div>
</footer>

<!-- Theme Toggle Script -->
<script>
document.getElementById("themeToggle").addEventListener("click", function () {
    let body = document.body;

    if (body.classList.contains("aspro-light")) {
        body.classList.replace("aspro-light", "aspro-dark");
        localStorage.setItem("asproTheme", "dark");
    } else {
        body.classList.replace("aspro-dark", "aspro-light");
        localStorage.setItem("asproTheme", "light");
    }
});

// Apply saved theme on startup
window.addEventListener("DOMContentLoaded", function () {
    const savedTheme = localStorage.getItem("asproTheme") || "light";
    document.body.classList.add("aspro-" + savedTheme);
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

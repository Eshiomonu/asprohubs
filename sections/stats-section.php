<?php
// Stats
$stats = [
    ["icon" => "bi-people", "value" => "15,000+", "label" => "Active Students"],
    ["icon" => "bi-award", "value" => "98%", "label" => "Pass Rate"],
    ["icon" => "bi-book", "value" => "50+", "label" => "Expert Instructors"],
    ["icon" => "bi-graph-up-arrow", "value" => "95%", "label" => "Satisfaction Rate"],
];

?>

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

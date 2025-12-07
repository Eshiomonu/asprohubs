<?php
$featuredCourses = $featuredCourses ?? [
    [
        "id" => 1,
        "title" => "Project Management Professional (PMP)",
        "short_desc" => "Learn globally-recognized PM frameworks & methodologies.",
        "image" => "./assets/images/pmp.jpg"
    ],
    [
        "id" => 2,
        "title" => "Certified Business Analysis Professional (CBAP)",
        "short_desc" => "Master business analysis techniques and frameworks.",
        "image" => "./assets/images/cbap.jpg"
    ],
    [
        "id" => 3,
        "title" => "ITIL Service Management",
        "short_desc" => "Develop skills in IT service operations and delivery.",
        "image" => "./assets/images/ITIL.png"
    ],
    [
        "id" => 4,
        "title" => "CompTIA Security+",
        "short_desc" => "Build foundational cybersecurity competencies.",
        "image" => "./assets/images/CompTIA.jpg"
    ],
    [
        "id" => 5,
        "title" => "Cloud Practitioner (AWS / Azure)",
        "short_desc" => "Understand cloud concepts & architectural best practices.",
        "image" => "./assets/images/cloud.jpg"
    ],
    [
        "id" => 6,
        "title" => "Data Analytics (Power BI + Excel)",
        "short_desc" => "Hands-on analytics learning with dashboards & reports.",
        "image" => "/assets/images/power.wbep"
    ]
];
?>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Featured Courses</h2>
            <p class="text-muted">Upgrade your career with expert-led professional training</p>
        </div>

        <div class="row g-4">
            <?php foreach ($featuredCourses as $course): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100 border-0">
                        <img src="<?= htmlspecialchars($course['image']) ?>"
                             class="card-img-top"
                             alt="<?= htmlspecialchars($course['title']) ?>"
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title fw-semibold">
                                <?= htmlspecialchars($course['title']) ?>
                            </h5>

                            <p class="text-muted small">
                                <?= htmlspecialchars($course['short_desc']) ?>
                            </p>
                        </div>

                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="/course?id=<?= $course['id'] ?>"
                               class="btn btn-primary w-100">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="/courses" class="btn btn-outline-primary btn-lg px-5">
                View All Courses
            </a>
        </div>
    </div>
</section>

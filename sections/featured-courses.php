<?php
$featuredCourses = $featuredCourses ?? [
    [
        "id" => 1,
        "title" => "Project Management Professional (PMP)",
        "short_desc" => "Learn globally-recognized PM frameworks & methodologies.",
        "image" => "./assets/images/pmp.jpg",
        "category" => "Project Management",
        "rating" => 4.8,
        "duration" => "18h 20m",
        "students" => "2,450",
        "price" => "$120"
    ],
    [
        "id" => 2,
        "title" => "Certified Business Analysis Professional (CBAP)",
        "short_desc" => "Master business analysis techniques and frameworks.",
        "image" => "./assets/images/cbap.jpg",
        "category" => "Business Analysis",
        "rating" => 4.6,
        "duration" => "15h 10m",
        "students" => "1,985",
        "price" => "$95"
    ],
    [
        "id" => 3,
        "title" => "ITIL Service Management",
        "short_desc" => "Develop skills in IT service operations and delivery.",
        "image" => "./assets/images/ITIL.png",
        "category" => "IT Service Management",
        "rating" => 4.7,
        "duration" => "14h 50m",
        "students" => "3,120",
        "price" => "$110"
    ],
    [
        "id" => 4,
        "title" => "CompTIA Security+",
        "short_desc" => "Build foundational cybersecurity competencies.",
        "image" => "./assets/images/CompTIA.jpg",
        "category" => "Cybersecurity",
        "rating" => 4.4,
        "duration" => "20h 00m",
        "students" => "2,050",
        "price" => "$140"
    ],
    [
        "id" => 5,
        "title" => "Cloud Practitioner (AWS / Azure)",
        "short_desc" => "Understand cloud concepts & architectural best practices.",
        "image" => "./assets/images/cloud.jpg",
        "category" => "Cloud Computing",
        "rating" => 4.9,
        "duration" => "10h 40m",
        "students" => "3,810",
        "price" => "$130"
    ],
    [
        "id" => 6,
        "title" => "Data Analytics (Power BI + Excel)",
        "short_desc" => "Hands-on analytics learning with dashboards & reports.",
        "image" => "./assets/images/power.png",
        "category" => "Data Analytics",
        "rating" => 4.7,
        "duration" => "16h 15m",
        "students" => "4,200",
        "price" => "$115"
    ]
];
?>


<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Featured Courses</h2>
            <p class="text-muted">Start your journey to professional certification with our top-rated courses</p>
        </div>

        <div class="row g-4">
            <?php foreach ($featuredCourses as $course): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card aspro-course-card shadow-sm">

                        <!-- Featured Image -->
                        <img src="<?= $course['image']; ?>" class="card-img-top" alt="<?= $course['title']; ?>">

                        <div class="card-body">

                            <!-- Category Badge -->
                            <span class="badge bg-aspro-primary mb-2">Certification</span>

                            <!-- Title -->
                            <h5 class="fw-semibold course-title"><?= $course['title']; ?></h5>

                            <!-- Rating -->
                            <div class="aspro-rating mb-2">
                                <span class="text-warning">★★★★☆</span>
                                <small class="text-muted ms-1">(4.8)</small>
                            </div>

                            <!-- Description -->
                            <p class="text-muted small mb-3"><?= $course['short_desc']; ?></p>

                            <!-- Duration & Students -->
                            <div class="d-flex justify-content-between text-muted small mb-3">
                                <span><i class="bi bi-clock"></i> 10h</span>
                                <span><i class="bi bi-people"></i> 2,340 enrolled</span>
                            </div>

                            <!-- Price + Button -->
                            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                <span class="fw-bold text-aspro-primary fs-5">$49</span>
                                <a href="/course-details.php?id=<?= $course['id']; ?>" class="btn btn-aspro btn-sm">
                                    View Details
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="/courses" class="btn btn-aspro-outline btn-lg px-5">View All Courses</a>
        </div>
    </div>
</section>


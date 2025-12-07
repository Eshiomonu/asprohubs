<?php
$questions = [
    [
        "question" => "Which process group involves defining and refining objectives?",
        "options" => ["Initiating", "Planning", "Executing", "Monitoring and Controlling"],
        "correct" => 1,
        "explanation" => "The Planning process group defines and refines project objectives."
    ],
    [
        "question" => "What is the purpose of a Work Breakdown Structure (WBS)?",
        "options" => [
            "To assign tasks to team members",
            "To decompose deliverables into smaller components",
            "To track project costs",
            "To manage stakeholder expectations"
        ],
        "correct" => 1,
        "explanation" => "The WBS decomposes deliverables into smaller items called work packages."
    ],
    [
        "question" => "Which document is created during project closure?",
        "options" => ["Project Charter", "Risk Register", "Lessons Learned", "Resource Calendar"],
        "correct" => 2,
        "explanation" => "Lessons Learned documentation is created during project closure."
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PMP Test Prep</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
        .option-box { cursor: pointer; }
        .option-selected { border: 2px solid #0d6efd; background: #e7f1ff; }
        .correct { background: #d1e7dd; border-color: #0f5132 !important; }
        .incorrect { background: #f8d7da; border-color: #842029 !important; }
    </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">ASPRO Academy</a>
  </div>
</nav>

<div class="container" style="max-width: 700px">

    <!-- Header -->
    <div class="text-center mb-4">
        <h2 class="fw-bold">PMP Exam Preparation</h2>
        <p class="text-muted">Practice questions to prepare for your certification exam</p>
    </div>

    <!-- Progress -->
    <div id="progressArea">
        <div class="d-flex justify-content-between mb-1">
            <small id="progressText">Question 1 of <?= count($questions) ?></small>
            <small id="progressPercent">0%</small>
        </div>
        <div class="progress mb-4">
            <div id="progressBar" class="progress-bar" style="width: 0%"></div>
        </div>
    </div>

    <!-- Question Card -->
    <div class="card mb-4" id="questionCard">
        <div class="card-body">
            <h5 id="questionText"></h5>
            <div id="optionsArea" class="mt-3"></div>

            <button class="btn btn-primary mt-4 float-end" id="nextBtn" disabled>
                Next Question
            </button>
            <div class="clearfix"></div>
        </div>
    </div>

    <!-- Results -->
    <div id="resultsCard" class="card d-none">
        <div class="card-body text-center">
            <h3 class="fw-bold text-success">Test Completed!</h3>
            <p class="text-muted">Great job completing the assessment.</p>

            <div class="row mt-4">
                <div class="col-4">
                    <h4 id="scorePercent" class="fw-bold text-primary">0%</h4>
                    <small>Score</small>
                </div>
                <div class="col-4">
                    <h4 id="scoreCorrect" class="fw-bold">0/0</h4>
                    <small>Correct</small>
                </div>
                <div class="col-4">
                    <h4 class="fw-bold">—</h4>
                    <small>Time</small>
                </div>
            </div>

            <button class="btn btn-outline-primary mt-4" onclick="restartTest()">
                Retry Test
            </button>
        </div>
    </div>


</div>

<script>
const questions = <?= json_encode($questions) ?>;
let current = 0;
let answers = []; // selected answers

// UI elements
const questionText = document.getElementById("questionText");
const optionsArea = document.getElementById("optionsArea");
const nextBtn = document.getElementById("nextBtn");
const progressText = document.getElementById("progressText");
const progressPercent = document.getElementById("progressPercent");
const progressBar = document.getElementById("progressBar");

function loadQuestion() {
    let q = questions[current];

    // Reset UI
    questionText.innerHTML = q.question;
    optionsArea.innerHTML = "";
    nextBtn.disabled = true;

    progressText.innerHTML = `Question ${current + 1} of ${questions.length}`;
    let percent = Math.round(((current) / questions.length) * 100);
    progressPercent.innerHTML = percent + "%";
    progressBar.style.width = percent + "%";

    // Render options
    q.options.forEach((opt, index) => {
        let div = document.createElement("div");
        div.className = "p-3 border rounded mb-2 option-box";
        div.innerHTML = opt;

        div.onclick = () => selectOption(div, index);

        optionsArea.appendChild(div);
    });
}

function selectOption(element, index) {
    // Clear previous selections
    [...optionsArea.children].forEach(c => {
        c.classList.remove("option-selected");
    });

    element.classList.add("option-selected");
    answers[current] = index;
    nextBtn.disabled = false;
}

nextBtn.onclick = () => {
    if (current < questions.length - 1) {
        current++;
        loadQuestion();
    } else {
        showResults();
    }
};

function showResults() {
    document.getElementById("questionCard").classList.add("d-none");
    document.getElementById("progressArea").classList.add("d-none");
    document.getElementById("resultsCard").classList.remove("d-none");

    let correct = 0;
    questions.forEach((q, i) => {
        if (q.correct === answers[i]) correct++;
    });

    let percent = Math.round((correct / questions.length) * 100);

    document.getElementById("scorePercent").innerHTML = percent + "%";
    document.getElementById("scoreCorrect").innerHTML =
        `${correct}/${questions.length}`;
}

function restartTest() {
    location.reload();
}

loadQuestion();
</script>

</body>
</html>

<?php
// -----------------------------------
// BASE URL - Detect Localhost / Production
// -----------------------------------
$hostName = $_SERVER['HTTP_HOST'];
$scriptName = $_SERVER['SCRIPT_NAME'];

if (strpos($hostName, 'localhost') !== false) {
    // Local environment
    $folder = trim(dirname($scriptName), '/'); 
    $folder = explode('/', $folder)[0]; // e.g., 'asprohubs'
    define('BASE_URL', '/' . $folder);
} else {
    // Production environment
    define('BASE_URL', ''); // root domain
}

// Optional full URL for redirects or emails
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
define('FULL_BASE_URL', $protocol . "://" . $_SERVER['HTTP_HOST'] . BASE_URL);


// -----------------------------------
// Database Configuration
// -----------------------------------
define('DB_HOST', 'localhost');
define('DB_NAME', 'asprohub');
define('DB_USER', 'root');
define('DB_PASS', '');

// -----------------------------------
// PDO Database Connection
// -----------------------------------
try {
    $conn = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS
    );

    // Set PDO error mode to Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Friendly error message for dev
    die("Database Connection Failed: " . $e->getMessage());
}

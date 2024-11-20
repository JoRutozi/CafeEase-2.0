<?php
//start session

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Other constant definitions and configurations


// Retrieve form data

// Database connection

// Define SITEURL if not already defined
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/Project_1/');
}

// Other constant definitions and configurations

$conn = mysqli_init();
mysqli_real_connect($conn, 'cafe-ease.mysql.database.azure.com', 'db_admin', 'cafe-ease123', 'cafe_ease', 3306);
if (mysqli_connect_errno()) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}

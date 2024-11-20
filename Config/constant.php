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


$servername = "cafe-ease.mysql.database.azure.com";
$username = "db_admin";
$password = "cafe-ease123"; // Make sure to provide the correct password for your MySQL server
$dbname = "cafe_ease";
$port = 3306;

$conn = mysqli_init();
if (!$conn) {
    die("MySQLi initialization failed.");
}

// Create connection
if(!mysqli_real_connect($conn, $servername, $username, $password, $dbname, $port)) {
   die("Connection failed: " . mysqli_connect_error());
} else {   
    echo "Securely connected to Azure MySQL Database!";
}
?>

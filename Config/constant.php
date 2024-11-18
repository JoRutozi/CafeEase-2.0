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


$servername = "cafeease-server.mysql.database.azure.com";
$username = "vgiihukgpd";
$password = "AiLOp$$GH42xbWLo"; // Make sure to provide the correct password for your MySQL server
$dbname = "cafe_ease";
$port = 3306;

$ssl_cert = "C:\Users\User\Downloads\BaltimoreCyberTrustRoot.crt.pem";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

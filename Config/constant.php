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

$conn = mysqli_init();
if (!$conn) {
    die("MySQLi initialization failed.");
}

mysqli_ssl_set($conn, NULL, NULL, $ssl_cert, NULL, NULL);

// Create connection
if(!mysqli_real_connect($conn, $servername, $username, $password, $dbname, $port)) {
   die("Connection failed: " . mysqli_connect_error());
} else {   
    echo "Securely connected to Azure MySQL Database!";
}
?>

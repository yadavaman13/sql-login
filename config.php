<?php
// Database configuration
$servername = "localhost";
$username = "root";        // Default XAMPP username
$password = "";            // Default XAMPP password (empty)
$dbname = "login_system";  // Database name we'll create

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8 to avoid character encoding issues
$conn->set_charset("utf8");
?>

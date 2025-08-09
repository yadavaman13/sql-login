<?php
// Database setup script
// Run this file once to create the database and table

$servername = "localhost";
$username = "root";
$password = "";

// Create connection without selecting database
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS login_system";
if ($conn->query($sql) === TRUE) {
    echo "Database 'login_system' created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db("login_system");

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Optional: Insert a test user (password: testpass)
$test_username = "testuser";
$test_email = "test@example.com";
$test_password = password_hash("testpass", PASSWORD_DEFAULT);

// Check if test user already exists
$check_sql = "SELECT username FROM users WHERE username = '$test_username'";
$result = $conn->query($check_sql);

if ($result->num_rows == 0) {
    $insert_sql = "INSERT INTO users (username, email, password) VALUES ('$test_username', '$test_email', '$test_password')";
    if ($conn->query($insert_sql) === TRUE) {
        echo "Test user created successfully.<br>";
        echo "Username: testuser<br>";
        echo "Password: testpass<br>";
    } else {
        echo "Error creating test user: " . $conn->error . "<br>";
    }
} else {
    echo "Test user already exists.<br>";
}

$conn->close();

echo "<br><strong>Database setup completed!</strong><br>";
echo "<a href='index.php'>Go to Login Page</a>";
?>

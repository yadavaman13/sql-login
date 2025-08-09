<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: register.php");
        exit();
    }
    
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters long!";
        header("Location: register.php");
        exit();
    }
    
    // Check if username already exists
    $check_user = "SELECT username FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_user);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username already exists!";
        $stmt->close();
        header("Location: register.php");
        exit();
    }
    $stmt->close();
    
    // Check if email already exists
    $check_email = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email already registered!";
        $stmt->close();
        header("Location: register.php");
        exit();
    }
    $stmt->close();
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert new user
    $sql = "INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! You can now login.";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
        header("Location: register.php");
    }
    
    $stmt->close();
}

$conn->close();
exit();
?>

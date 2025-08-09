<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include 'config.php';

// Get user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, created_at FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Login System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #ddd;
        }
        h1 {
            color: #333;
            margin: 0;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .user-info {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .user-info h3 {
            margin-top: 0;
            color: #495057;
        }
        .info-item {
            margin-bottom: 0.5rem;
        }
        .info-label {
            font-weight: bold;
            color: #6c757d;
        }
        .welcome-message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .content {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dashboard</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="welcome-message">
                <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>
        
        <div class="user-info">
            <h3>User Information</h3>
            <div class="info-item">
                <span class="info-label">Username:</span> <?php echo htmlspecialchars($user['username']); ?>
            </div>
            <div class="info-item">
                <span class="info-label">Email:</span> <?php echo htmlspecialchars($user['email']); ?>
            </div>
            <div class="info-item">
                <span class="info-label">Member since:</span> <?php echo date('F j, Y', strtotime($user['created_at'])); ?>
            </div>
        </div>
        
        <div class="content">
            <h3>Welcome to your Dashboard!</h3>
            <p>You have successfully logged in to the system. This is a secure area that only authenticated users can access.</p>
            <p>From here, you can:</p>
            <ul>
                <li>View your profile information</li>
                <li>Update your account settings</li>
                <li>Access protected content</li>
                <li>Manage your account</li>
            </ul>
        </div>
    </div>
</body>
</html>

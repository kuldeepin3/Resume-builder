<?php
session_start();
// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            min-height: 100vh;
            padding: 20px;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.15);
        }
        .welcome-message {
            text-align: center;
            margin-bottom: 2rem;
        }
        .user-info {
            background: #f5f5f5;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 1rem;
        }
        .logout-btn:hover {
            background: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="welcome-message">
            <h1>Welcome to Your Dashboard, <?php echo $_SESSION['user_name']; ?>!</h1>
            <p>You have successfully logged in to your account</p>
        </div>
        
        <div class="user-info">
            <h2>Your Profile Information</h2>
            <p><strong>User ID:</strong> <?php echo $_SESSION['user_id']; ?></p>
            <p><strong>Name:</strong> <?php echo $_SESSION['user_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $_SESSION['user_email']; ?></p>
        </div>
        
        <div class="dashboard-features">
            <h2>Dashboard Features</h2>
            <ul>
                <li>View and edit your profile</li>
                <li>Access exclusive content</li>
                <li>Manage your account settings</li>
                <li>Track your activity</li>
            </ul>
        </div>
        
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
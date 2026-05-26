 <?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Show quick welcome then redirect
?>
<!DOCTYPE html>
<html>
<head>
    <title>Redirecting...</title>
</head>
<body>
    <script>
        alert('Welcome back, <?php echo $_SESSION['user_name']; ?>!');
        window.location.href = 'v.html';
    </script>
</body>
</html>
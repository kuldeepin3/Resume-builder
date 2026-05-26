 <?php
session_start();
include('connect.php');

if(isset($_POST['signIn'])) {
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];
        
        if(empty($email) || empty($password)) {
            header("Location: login.php?login_error=Email and password are required");
            exit();
        }
        
        $query = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        
        if($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            if(password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['Id'];
                $_SESSION['user_name'] = $user['firstName'] . ' ' . $user['lastName'];
                $_SESSION['user_email'] = $user['email'];
                
                // Redirect with success parameter
                header("Location: v.html?login=success&user=" . urlencode($user['firstName']));
                exit();
            } else {
                header("Location: login.php?login_error=Invalid email or password");
                exit();
            }
        } else {
            header("Location: login.php?login_error=Invalid email or password");
            exit();
        }
    } else {
        header("Location: login.php?login_error=Email and password are required");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
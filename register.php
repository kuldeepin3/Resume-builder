 <?php
session_start();
include('connect.php');

if(isset($_POST['signUp'])) {
    // Check if all fields are set
    if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password'])) {
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];
        
        // Validate input
        if(empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
            header("Location: register.php?error=All fields are required");
            exit();
        }
        
        // Check if email already exists
        $checkEmail = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $checkEmail);
        
        if($result) {
            $count = mysqli_num_rows($result);
            
            if($count > 0) {
                header("Location: register.php?error=Email already exists");
                exit();
            }
            
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user into database
            $insertQuery = "INSERT INTO user (firstName, lastName, email, password) 
                            VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";
            
            if(mysqli_query($conn, $insertQuery)) {
                header("Location: login.php?success=Registration successful. Please login.");
                exit();
            } else {
                header("Location: register.php?error=Registration failed: " . mysqli_error($conn));
                exit();
            }
        } else {
            header("Location: register.php?error=Database query error");
            exit();
        }
    } else {
        header("Location: register.php?error=All fields are required");
        exit();
    }
}
// REMOVED THE REDIRECT LOOP - Don't redirect if form wasn't submitted
// The HTML form will simply display below
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Resume Builder Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }

        .hero-section {
            flex: 1;
            color: white;
            padding: 60px;
            max-width: 600px;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #fff, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            line-height: 1.6;
            opacity: 0.9;
        }

        .features {
            margin: 40px 0;
        }

        .feature-item {
            display:flex;
            align-items:center;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        .feature-item i {
            font-size: 1.5rem;
            margin-right: 15px;
            color: #7c4dff;
            background: white;
            padding: 10px;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cta-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .cta-box h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #7c4dff;
        }

        .cta-box p {
            font-size: 1rem;
            margin-bottom: 0;
        }

        .container {
            background: #fff;
            width: 450px;
            padding: 4rem;
            border-radius: 19px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            margin-left: 20px;
            margin-right: 90px;
        }

        form {
            margin: 0 1rem;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            padding: 1rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .input-group {
            position: relative;
            margin: 1.5rem 0;
        }

        .input-group i {
            position: absolute;
            top: 15px;
            left: 10px;
            color: #6c757d;
        }

        .input-group input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            outline: none;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #7c4dff;
            box-shadow: 0 0 0 3px rgba(124, 77, 255, 0.1);
        }

        .input-group label {
            position: absolute;
            left: 40px;
            top: 12px;
            color: #6c757d;
            pointer-events: none;
            transition: 0.3s ease all;
        }

        .input-group input:focus ~ label,
        .input-group input:not(:placeholder-shown) ~ label {
            top: -10px;
            left: 35px;
            font-size: 0.8rem;
            background: white;
            padding: 0 5px;
            color: #7c4dff;
            font-weight: 500;
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #7c4dff, #6b3dff);
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            margin: 1.5rem 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(124, 77, 255, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(124, 77, 255, 0.4);
        }

        .or {
            text-align: center;
            margin: 1.5rem 0;
            color: #6c757d;
            position: relative;
        }

        .or::before,
        .or::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background: #e2e8f0;
        }

        .or::before {
            left: 0;
        }

        .or::after {
            right: 0;
        }

        .icons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 1.5rem 0;
        }

        .icons i {
            font-size: 1.5rem;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 10px;
            border-radius: 50%;
            background: #f8f9fa;
        }

        .icons i:hover {
            color: #7c4dff;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .links {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 1.5rem;
        }

        .links p {
            margin: 0;
            color: #6c757d;
        }

        .links a {
            background: none;
            border: none;
            color: #7c4dff;
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            margin-left: 5px;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: #6b3dff;
            text-decoration: underline;
        }
        
        .message {
            padding: 12px;
            margin: 15px 0;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
        }
        
        .error {
            background-color: #ffebee;
            color: #f44336;
            border: 2px solid #f44336;
        }
        
        .success {
            background-color: #e8f5e9;
            color: #4caf50;
            border: 2px solid #4caf50;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
                justify-content: center;
            }
            
            .hero-section {
                padding: 30px;
                text-align: center;
                max-width: 100%;
            }
            
            .container {
                margin-left: 0;
                margin-top: 20px;
                width: 100%;
                max-width: 450px;
            }
        }
    </style>
</head>

<body>
    <!-- Left Side Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>Resume Builder</h1>
            <p>Create stunning resumes that get you noticed by employers. Choose from professional templates and land your dream job.</p>
            
            <div class="features">
                <div class="feature-item">
                    <i class="fas fa-magic"></i>
                    <span>Professional Templates</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-file-alt"></i>
                    <span>Easy-to-Use Editor</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-download"></i>
                    <span>Download in Multiple Formats</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-bolt"></i>
                    <span>Quick & Easy Setup</span>
                </div>
            </div>
            
            <div class="cta-box">
                <h3>Start Your Journey Today</h3>
                <p>Join thousands of professionals who have landed their dream jobs with resumes created using our platform. Sign up now to access all features and create your perfect resume!</p>
            </div>
        </div>
    </div>

    <!-- Right Side Registration Form -->
    <div class="container">
        <h1 class="form-title">Create Account</h1>
        <div id="message-container">
            <?php
            if (isset($_GET['error'])) {
                echo '<div class="message error">' . htmlspecialchars($_GET['error']) . '</div>';
            }
            if (isset($_GET['success'])) {
                echo '<div class="message success">' . htmlspecialchars($_GET['success']) . '</div>';
            }
            ?>
        </div>
        <form method="POST" action="register.php" onsubmit="return validateForm()">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="firstName" id="firstName" placeholder=" " required>
                <label for="firstName">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lastName" id="lastName" placeholder=" " required>
                <label for="lastName">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder=" " required minlength="6">
                <label for="password">Password (min. 6 characters)</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
            <p class="or">
                -------or-------
            </p>
            
            <div class="links">
                <p>Already have an account?</p>
                <a href="login.php">Sign In</a>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            
            // Basic validation
            if (firstName === '' || lastName === '' || email === '' || password === '') {
                alert('All fields are required');
                return false;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }
            
            // Password length validation
            if (password.length < 6) {
                alert('Password must be at least 6 characters long');
                return false;
            }
            
            return true;
        }

        // Add floating label functionality
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.input-group input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
        });
    </script>
</body>
</html>
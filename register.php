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
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Poppins', sans-serif;
        }

        :root {
            --bg-dark: #090a0f;
            --bg-card: rgba(17, 19, 31, 0.75);
            --border-color: rgba(255, 255, 255, 0.08);
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.2);
            --secondary: #a855f7;
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
        }

        body {
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(at 10% 20%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(168, 85, 247, 0.15) 0px, transparent 50%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 40px;
            background-attachment: fixed;
            color: var(--text-main);
        }

        .hero-section {
            flex: 1;
            color: white;
            padding: 60px;
            max-width: 600px;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #ffffff 30%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-content p {
            font-size: 1.15rem;
            margin-bottom: 40px;
            line-height: 1.7;
            color: var(--text-muted);
        }

        .features {
            margin: 40px 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            font-size: 1.05rem;
        }

        .feature-item i {
            font-size: 1.3rem;
            margin-right: 15px;
            color: var(--primary);
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            padding: 12px;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cta-box {
            background: var(--bg-card);
            backdrop-filter: blur(15px);
            border: 1px solid var(--border-color);
            padding: 30px;
            border-radius: 20px;
        }

        .cta-box h3 {
            font-size: 1.3rem;
            margin-bottom: 12px;
            color: #fff;
        }

        .cta-box p {
            font-size: 0.95rem;
            color: var(--text-muted);
        }

        .container {
            background: var(--bg-card);
            backdrop-filter: blur(15px);
            border: 1px solid var(--border-color);
            width: 460px;
            padding: 3.5rem 3rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            margin-left: 20px;
            margin-right: 40px;
        }

        form {
            margin: 0;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 800;
            text-align: center;
            padding-bottom: 2rem;
            color: #fff;
        }

        .input-group {
            position: relative;
            margin: 1.8rem 0;
        }

        .input-group i {
            position: absolute;
            top: 16px;
            left: 14px;
            color: var(--text-muted);
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        .input-group input {
            width: 100%;
            padding: 14px 14px 14px 44px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            outline: none;
            font-size: 1rem;
            color: #fff;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
            background: rgba(255, 255, 255, 0.06);
        }

        .input-group input:focus ~ i {
            color: var(--primary);
        }

        .input-group label {
            position: absolute;
            left: 44px;
            top: 14px;
            color: var(--text-muted);
            pointer-events: none;
            transition: 0.3s ease all;
            font-size: 0.95rem;
        }

        .input-group input:focus ~ label,
        .input-group input:not(:placeholder-shown) ~ label {
            top: -12px;
            left: 12px;
            font-size: 0.8rem;
            background: #11131f;
            padding: 2px 8px;
            color: var(--primary);
            border-radius: 4px;
            border: 1px solid var(--border-color);
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            margin: 1.5rem 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px var(--primary-glow);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.35);
            filter: brightness(1.1);
        }

        .or {
            text-align: center;
            margin: 1.5rem 0;
            color: var(--text-muted);
            position: relative;
            font-size: 0.9rem;
        }

        .or::before,
        .or::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: var(--border-color);
        }

        .or::before {
            left: 0;
        }

        .or::after {
            right: 0;
        }

        .links {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }

        .links p {
            margin: 0;
            color: var(--text-muted);
        }

        .links a {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            margin-left: 6px;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }
        
        .message {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 12px;
            text-align: center;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .error {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        .success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        @media (max-width: 992px) {
            body {
                flex-direction: column;
                justify-content: center;
                padding: 20px;
            }
            
            .hero-section {
                padding: 30px;
                text-align: center;
                max-width: 100%;
                margin-bottom: 40px;
            }
            
            .container {
                margin: 0 auto;
                width: 100%;
                max-width: 460px;
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
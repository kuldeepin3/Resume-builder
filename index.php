<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration System</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: #fff;
            width: 450px;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.15);
        }

        form {
            margin: 0 2rem;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .input-group {
            position: relative;
            margin: 1.2rem 0;
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
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            font-size: 1rem;
        }

        .input-group input:focus {
            border-color: #7c4dff;
            box-shadow: 0 0 0 2px rgba(124, 77, 255, 0.2);
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
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background: #7c4dff;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            margin: 1rem 0;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #6b3dff;
        }

        .or {
            text-align: center;
            margin: 1rem 0;
            color: #6c757d;
        }

        .icons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 1rem 0;
        }

        .icons i {
            font-size: 1.5rem;
            color: #6c757d;
            cursor: pointer;
            transition: color 0.3s;
        }

        .icons i:hover {
            color: #7c4dff;
        }

        .links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .links p {
            margin: 0;
            color: #6c757d;
        }

        .links button {
            background: none;
            border: none;
            color: #7c4dff;
            cursor: pointer;
            text-decoration: underline;
            font-size: 1rem;
        }

        .recover {
            text-align: right;
            margin: 0.5rem 0;
        }

        .recover a {
            color: #7c4dff;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            text-align: center;
        }
        
        .error {
            background-color: #ffebee;
            color: #f44336;
            border: 1px solid #f44336;
        }
        
        .success {
            background-color: #e8f5e9;
            color: #4caf50;
            border: 1px solid #4caf50;
        }
        
        #signIn {
            display: none;
        }
        
        .dashboard {
            display: none;
            width: 80%;
            max-width: 800px;
        }
        
        .dashboard-content {
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
            display: block;
            width: 100%;
            padding: 12px;
            background: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
            margin-top: 1rem;
        }
        
        .logout-btn:hover {
            background: #d32f2f;
        }
    </style>
</head>

<body>
    <!-- Login/Register Forms -->
    <div class="container" id="signup">
        <h1 class="form-title">Register</h1>
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
        <form method="POST" action="register.php">
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
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
            <p class="or">
                -------or-------
            </p>
            <div class="icons">
                <i class="fab fa-google"></i>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-linkedin"></i>
            </div>
            <div class="links">
                <p>Already Have Account?</p>
                <button type="button" id="signInButton">Sign In</button>
            </div>
        </form>
    </div>

    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <div id="login-message-container">
            <?php
            if (isset($_GET['login_error'])) {
                echo '<div class="message error">' . htmlspecialchars($_GET['login_error']) . '</div>';
            }
            ?>
        </div>
        <form method="POST" action="login.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="loginEmail" placeholder=" " required>
                <label for="loginEmail">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="loginPassword" placeholder=" " required>
                <label for="loginPassword">Password</label>
                <p class="recover">
                    <a href="#">Recover Password</a>
                </p>
            </div>
            <input type="submit" class="btn" value="Sign In" name="signIn">
            <p class="or">
                -------or-------
            </p>
            <div class="icons">
                <i class="fab fa-google"></i>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-linkedin"></i>
            </div>
            <div class="links">
                <p>Don't Have Account?</p>
                <button type="button" id="signUpButton">Sign Up</button>
            </div>
        </form>
    </div>

    <!-- Dashboard (initially hidden) -->
    <div class="dashboard" id="dashboard">
        <div class="dashboard-content">
            <div class="welcome-message">
                <h1>Welcome to Your Dashboard</h1>
                <p>You have successfully logged in to your account</p>
            </div>
            
            <div class="user-info">
                <h2>Your Profile Information</h2>
                <p><strong>User ID:</strong> <span id="user-id"></span></p>
                <p><strong>Name:</strong> <span id="user-name"></span></p>
                <p><strong>Email:</strong> <span id="user-email"></span></p>
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
    </div>

    <script>
        // Form switching functionality
        document.getElementById('signInButton').addEventListener('click', function() {
            document.getElementById('signup').style.display = 'none';
            document.getElementById('signIn').style.display = 'block';
            document.getElementById('dashboard').style.display = 'none';
        });

        document.getElementById('signUpButton').addEventListener('click', function() {
            document.getElementById('signIn').style.display = 'none';
            document.getElementById('signup').style.display = 'block';
            document.getElementById('dashboard').style.display = 'none';
        });
        
        // Check if user is logged in (simulated for demo)
        function checkLoginStatus() {
            // This is a simulation - in a real application, you would check session or cookies
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('login') === 'success') {
                showDashboard();
            }
        }
        
        function showDashboard() {
            document.getElementById('signIn').style.display = 'none';
            document.getElementById('signup').style.display = 'none';
            document.getElementById('dashboard').style.display = 'block';
            
            // Set user data (in a real app, this would come from the server)
            document.getElementById('user-id').textContent = '12345';
            document.getElementById('user-name').textContent = 'John Doe';
            document.getElementById('user-email').textContent = 'john.doe@example.com';
        }
        
        // Initialize the page
        document.getElementById('signup').style.display = 'block';
        document.getElementById('signIn').style.display = 'none';
        document.getElementById('dashboard').style.display = 'none';
        
        // Check login status on page load
        checkLoginStatus();
    </script>
</body>
</html>
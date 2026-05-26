<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration System</title>
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
            justify-content: center;
            padding: 40px;
            background-attachment: fixed;
            color: var(--text-main);
        }

        .container {
            background: var(--bg-card);
            backdrop-filter: blur(15px);
            border: 1px solid var(--border-color);
            width: 460px;
            padding: 3.5rem 3rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
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

        .icons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 1.5rem 0;
        }

        .icons i {
            font-size: 1.5rem;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icons i:hover {
            color: var(--primary);
            border-color: rgba(99, 102, 241, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }

        .links p {
            margin: 0;
            color: var(--text-muted);
        }

        .links button {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .links button:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        .recover {
            text-align: right;
            margin-top: 0.5rem;
        }

        .recover a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .recover a:hover {
            color: var(--primary);
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
        
        #signIn {
            display: none;
        }
        
        .dashboard {
            display: none;
            width: 80%;
            max-width: 800px;
        }
        
        .dashboard-content {
            background: var(--bg-card);
            backdrop-filter: blur(15px);
            border: 1px solid var(--border-color);
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }
        
        .welcome-message {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .welcome-message h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #ffffff 0%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-message p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }
        
        .user-info {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border-color);
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
        }

        .user-info h2 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #fff;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
        }

        .user-info p {
            font-size: 1.05rem;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .user-info strong {
            color: #fff;
        }

        .dashboard-features h2 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            color: #fff;
        }

        .dashboard-features ul {
            list-style: none;
            padding-left: 0;
        }

        .dashboard-features li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 12px;
            color: var(--text-muted);
            font-size: 1rem;
        }

        .dashboard-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: bold;
        }
        
        .logout-btn {
            display: block;
            width: 100%;
            padding: 14px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border-radius: 12px;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            text-align: center;
            margin-top: 2rem;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.25);
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
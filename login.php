<?php
session_start();
include "config.php"; // Make sure to create this file with database connection

$error = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Validate inputs
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields";
    } else {
        // Use prepared statement to prevent SQL injection
        $sql = "SELECT id, password, role, name FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Verify password (assuming passwords are hashed)
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $email;
                $_SESSION['role'] = $row['role'];
                $_SESSION['loggedin'] = true;
                
                // Redirect based on role
                if ($row['role'] == "admin") {
                    header("Location: admin/dashboard.php");
                } else {
                    header("Location: index.php");
                }
                exit;
            } else {
                $error = "Invalid email or password!";
            }
        } else {
            $error = "Invalid email or password!";
        }
        $stmt->close();
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pet Adoption Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Background images of dogs and cats */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                url('https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80') right bottom/300px no-repeat,
                url('https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80') left top/250px no-repeat,
                url('https://images.unsplash.com/photo-1560809454-892b55bce5f0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80') left bottom/200px no-repeat,
                url('https://images.unsplash.com/photo-1592194996308-7b43878e84a6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80') right top/280px no-repeat;
            opacity: 0.15;
            z-index: -1;
        }

        .login-container {
            display: flex;
            width: 900px;
            height: 550px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -70px;
            right: -70px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .login-left::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
            z-index: 1;
        }

        .logo i {
            margin-right: 10px;
            font-size: 32px;
        }

        .welcome-text h2 {
            font-size: 28px;
            margin-bottom: 15px;
            z-index: 1;
            position: relative;
        }

        .welcome-text p {
            line-height: 1.6;
            margin-bottom: 30px;
            z-index: 1;
            position: relative;
        }

        .features {
            margin-top: 30px;
            z-index: 1;
            position: relative;
        }

        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .feature i {
            margin-right: 10px;
            color: #ff6b6b;
            font-size: 18px;
        }

        .login-right {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.95);
        }

        .login-right h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 28px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .input-group input:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 3px rgba(108, 117, 125, 0.2);
            outline: none;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 43px;
            color: #6c757d;
            font-size: 18px;
        }

        .error {
            color: #e74c3c;
            background: #fde8e6;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: <?php echo !empty($error) ? 'block' : 'none'; ?>;
            text-align: center;
        }

        .success {
            color: #2ecc71;
            background: #eafaf1;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
            text-align: center;
        }

        .success.show {
            display: block;
        }

        button.login-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: #6c757d;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        button.login-btn:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .links {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .links a {
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .links a:hover {
            color: #ff6b6b;
            text-decoration: underline;
        }

        .register-link {
            text-align: center;
            margin-top: 30px;
            color: #555;
        }

        .register-link a {
            color: #6c757d;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #ff6b6b;
            text-decoration: underline;
        }

        .pet-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .pet-icon {
            font-size: 24px;
            color: #6c757d;
            animation: float 3s ease-in-out infinite;
        }

        .pet-icon:nth-child(1) { animation-delay: 0s; }
        .pet-icon:nth-child(2) { animation-delay: 0.5s; }
        .pet-icon:nth-child(3) { animation-delay: 1s; }
        .pet-icon:nth-child(4) { animation-delay: 1.5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                height: auto;
                width: 100%;
                max-width: 500px;
            }
            
            .login-left {
                padding: 30px;
            }
            
            .login-right {
                padding: 30px;
            }

            body::before {
                background-size: 150px, 120px, 100px, 140px;
            }
        }

        @media (max-width: 480px) {
            .login-left, .login-right {
                padding: 20px;
            }
            
            .links {
                flex-direction: column;
                gap: 10px;
                align-items: center;
            }

            body::before {
                background-size: 100px, 80px, 70px, 90px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="logo">
                <i class="fas fa-paw"></i>
                <span>Pet Adoption Center</span>
            </div>
            <div class="welcome-text">
                <h2>Welcome Back!</h2>
                <p>Log in to continue your journey of finding the perfect pet companion. Together, we can make a difference in the lives of animals.</p>
            </div>
            <div class="features">
                <div class="feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Find your perfect pet match</span>
                </div>
                <div class="feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Track your adoption process</span>
                </div>
                <div class="feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Manage your favorites</span>
                </div>
                <div class="feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Get personalized recommendations</span>
                </div>
            </div>
        </div>
        
        <div class="login-right">
            <h2>Login to Your Account</h2>
            
            <div class="pet-icons">
                <i class="fas fa-dog pet-icon"></i>
                <i class="fas fa-cat pet-icon"></i>
                <i class="fas fa-paw pet-icon"></i>
                <i class="fas fa-heart pet-icon"></i>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <div class="success" id="successMessage">
                Login successful! Redirecting to homepage...
            </div>
            
            <form method="post" action="">
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                
                <div class="input-group">
                    <label for="password">Password</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                
                <button type="submit" name="login" class="login-btn">Login</button>
                
                <div class="links">
                    <a href="#"><i class="fas fa-question-circle"></i> Forgot Password?</a>
                    <a href="#"><i class="fas fa-user-shield"></i> Privacy Policy</a>
                </div>
            </form>
            
            <div class="register-link">
                Don't have an account? <a href="register.php">Register Now</a>
            </div>
        </div>
    </div>

    <script>
        // Add interactive effects to input fields
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.querySelector('i').style.color = '#ff6b6b';
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.querySelector('i').style.color = '#6c757d';
            });
        });
        
        // If there's an error, make sure the error message is visible
        <?php if (!empty($error)): ?>
            document.querySelector('.error').style.display = 'block';
        <?php endif; ?>
    </script>
</body>
</html>
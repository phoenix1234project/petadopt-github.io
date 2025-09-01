<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page after 2 seconds
header("refresh:2; url=login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Pet Adoption Center</title>
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
        }

        .logout-container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .logout-icon {
            font-size: 80px;
            color: #6c757d;
            margin-bottom: 20px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 28px;
        }

        p {
            color: #666;
            margin-bottom: 30px;
            font-size: 18px;
        }

        .countdown {
            font-size: 20px;
            font-weight: bold;
            color: #0077cc;
            margin-top: 20px;
        }

        .login-link {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #0077cc;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link:hover {
            background: #005fa3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .footer {
            margin-top: 30px;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h2>Logout Successful</h2>
        <p>You have been successfully logged out of your account.</p>
        <div class="countdown">Redirecting to login page in <span id="countdown">2</span> seconds...</div>
        <a href="login.php" class="login-link">Click here to login again</a>
        <div class="footer">
            Pet Adoption Center | Made by Ekta & Kumkum
        </div>
    </div>

    <script>
        // Countdown timer
        let seconds = 2;
        const countdownElement = document.getElementById('countdown');
        
        const countdown = setInterval(function() {
            seconds--;
            countdownElement.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(countdown);
            }
        }, 1000);
    </script>
</body>
</html>
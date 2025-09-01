<?php
include "config.php";
// Prevent access if OTP/session data missing
if (!isset($_SESSION['otp']) || !isset($_SESSION['amount'])) {
    header("Location: payment.php");
    exit;
}

$otp_error = "";
$success_message = "";

if (isset($_POST['verify'])) {
    $entered_otp = $_POST['otp'];

    if ($entered_otp == $_SESSION['otp']) {
        $success_message = "Thank you for visiting our shop! Payment of ₹" . $_SESSION['amount'] . " for pet '" . $_SESSION['pet_name'] . "' is successful.";

        // Optional: Save this info to database here

        // Clear session data
        unset($_SESSION['otp']);
        unset($_SESSION['amount']);
        unset($_SESSION['pet_name']);
    } else {
        $otp_error = "Invalid OTP. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Pet Adoption Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        .bg-bubbles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-bubbles li {
            position: absolute;
            list-style: none;
            display: block;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.15);
            bottom: -160px;
            animation: square 25s infinite;
            transition-timing-function: linear;
            border-radius: 50%;
        }

        .bg-bubbles li:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
            width: 80px;
            height: 80px;
        }

        .bg-bubbles li:nth-child(2) {
            left: 20%;
            animation-delay: 2s;
            animation-duration: 17s;
            width: 60px;
            height: 60px;
        }

        .bg-bubbles li:nth-child(3) {
            left: 25%;
            animation-delay: 4s;
            width: 100px;
            height: 100px;
        }

        .bg-bubbles li:nth-child(4) {
            left: 40%;
            animation-delay: 0s;
            animation-duration: 22s;
            width: 120px;
            height: 120px;
        }

        .bg-bubbles li:nth-child(5) {
            left: 70%;
            animation-delay: 3s;
            width: 70px;
            height: 70px;
        }

        .bg-bubbles li:nth-child(6) {
            left: 80%;
            animation-delay: 2s;
            width: 90px;
            height: 90px;
        }

        .bg-bubbles li:nth-child(7) {
            left: 32%;
            animation-delay: 6s;
            width: 110px;
            height: 110px;
        }

        .bg-bubbles li:nth-child(8) {
            left: 55%;
            animation-delay: 8s;
            animation-duration: 18s;
            width: 50px;
            height: 50px;
        }

        .bg-bubbles li:nth-child(9) {
            left: 25%;
            animation-delay: 10s;
            animation-duration: 20s;
            width: 80px;
            height: 80px;
        }

        .bg-bubbles li:nth-child(10) {
            left: 90%;
            animation-delay: 5s;
            width: 60px;
            height: 60px;
        }

        @keyframes square {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 50%;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 20%;
            }
        }

        .otp-container {
            width: 480px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            padding: 40px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 700;
            color: #5e72e4;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .logo i {
            margin-right: 12px;
            font-size: 36px;
        }

        h2 {
            color: #2d3748;
            margin-bottom: 12px;
            font-size: 30px;
            font-weight: 700;
        }

        .subtitle {
            color: #718096;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }

        .pet-info {
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 30px;
            text-align: left;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #5e72e4;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .pet-info h3 {
            color: #5e72e4;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            font-size: 18px;
        }

        .pet-info h3 i {
            margin-right: 12px;
            font-size: 20px;
        }

        .pet-info p {
            color: #4a5568;
            margin: 8px 0;
            font-size: 15px;
        }

        .pet-info strong {
            color: #2d3748;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
            animation: fadeIn 1s ease-out;
        }

        .input-group label {
            display: block;
            margin-bottom: 10px;
            color: #4a5568;
            font-weight: 500;
            text-align: left;
            font-size: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 18px 18px 18px 50px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            font-size: 20px;
            transition: all 0.3s;
            text-align: center;
            letter-spacing: 10px;
            font-weight: 600;
            background: #f7fafc;
            color: #2d3748;
        }

        .input-group input:focus {
            border-color: #5e72e4;
            box-shadow: 0 0 0 4px rgba(94, 114, 228, 0.1);
            outline: none;
            background: white;
            transform: translateY(-2px);
        }

        .input-group i {
            position: absolute;
            left: 18px;
            top: 50px;
            color: #5e72e4;
            font-size: 20px;
            transition: all 0.3s;
        }

        .input-group input:focus + i {
            color: #ff6b6b;
            transform: scale(1.2);
        }

        .error {
            color: #e53e3e;
            background: #fed7d7;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: <?php echo !empty($otp_error) ? 'flex' : 'none'; ?>;
            align-items: center;
            justify-content: center;
            text-align: center;
            animation: shake 0.5s;
            border-left: 4px solid #e53e3e;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .error i {
            margin-right: 10px;
            font-size: 20px;
        }

        .success {
            color: #38a169;
            background: #f0fff4;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            display: <?php echo !empty($success_message) ? 'block' : 'none'; ?>;
            text-align: center;
            border-left: 4px solid #38a169;
            animation: zoomIn 0.6s;
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .success i {
            font-size: 60px;
            margin-bottom: 20px;
            display: block;
            color: #38a169;
            animation: tada 1s;
        }

        @keyframes tada {
            0% { transform: scale(1); }
            10%, 20% { transform: scale(0.9) rotate(-3deg); }
            30%, 50%, 70%, 90% { transform: scale(1.1) rotate(3deg); }
            40%, 60%, 80% { transform: scale(1.1) rotate(-3deg); }
            100% { transform: scale(1) rotate(0); }
        }

        .success h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #2d3748;
        }

        .success p {
            margin: 10px 0;
            color: #4a5568;
            line-height: 1.6;
        }

        button.verify-btn {
            width: 100%;
            padding: 18px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #5e72e4 0%, #825ee4 100%);
            color: white;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(94, 114, 228, 0.4);
            position: relative;
            overflow: hidden;
        }

        button.verify-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        button.verify-btn:hover:before {
            left: 100%;
        }

        button.verify-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(94, 114, 228, 0.6);
        }

        button.verify-btn:active {
            transform: translateY(1px);
        }

        .home-btn {
            display: inline-block;
            padding: 16px 35px;
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 25px;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(72, 187, 120, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(72, 187, 120, 0); }
            100% { box-shadow: 0 0 0 0 rgba(72, 187, 120, 0); }
        }

        .home-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(72, 187, 120, 0.6);
        }

        .home-btn i {
            margin-right: 8px;
        }

        .pet-icons {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin: 30px 0;
        }

        .pet-icon {
            font-size: 28px;
            color: #5e72e4;
            animation: float 3s ease-in-out infinite;
            background: rgba(94, 114, 228, 0.1);
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .pet-icon:nth-child(1) { animation-delay: 0s; }
        .pet-icon:nth-child(2) { animation-delay: 0.5s; }
        .pet-icon:nth-child(3) { animation-delay: 1s; }
        .pet-icon:nth-child(4) { animation-delay: 1.5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .countdown {
            font-size: 15px;
            color: #718096;
            margin-top: 15px;
            display: <?php echo !empty($success_message) ? 'block' : 'none'; ?>;
        }

        @media (max-width: 500px) {
            .otp-container {
                width: 90%;
                padding: 30px 20px;
            }
            
            .input-group input {
                letter-spacing: 8px;
                font-size: 18px;
                padding: 16px 16px 16px 45px;
            }
            
            .pet-icons {
                gap: 15px;
            }
            
            .pet-icon {
                width: 50px;
                height: 50px;
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </div>
    
    <div class="otp-container">
        <div class="logo">
            <i class="fas fa-paw"></i>
            <span>Pet Adoption Center</span>
        </div>
        
        <h2>OTP Verification</h2>
        <p class="subtitle">Enter the 6-digit code sent to your mobile</p>
        
        <div class="pet-info">
            <h3><i class="fas fa-receipt"></i> Payment Details</h3>
            <p><strong>Pet:</strong> <?php echo isset($_SESSION['pet_name']) ? $_SESSION['pet_name'] : 'N/A'; ?></p>
            <p><strong>Amount:</strong> ₹<?php echo isset($_SESSION['amount']) ? $_SESSION['amount'] : '0'; ?></p>
            <p><strong>Transaction ID:</strong> PET<?php echo rand(100000, 999999); ?></p>
        </div>
        
        <div class="pet-icons">
            <i class="fas fa-shield-alt pet-icon"></i>
            <i class="fas fa-lock pet-icon"></i>
            <i class="fas fa-key pet-icon"></i>
            <i class="fas fa-paw pet-icon"></i>
        </div>
        
        <?php if (!empty($otp_error)): ?>
            <div class="error">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo $otp_error; ?></span>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($success_message)): ?>
            <div class="success">
                <i class="fas fa-check-circle"></i>
                <h3>Payment Successful!</h3>
                <p><?php echo $success_message; ?></p>
                <p>Thank you for visiting our shop!</p>
                <a href="index.php" class="home-btn"><i class="fas fa-home"></i> Go to Home</a>
                <div class="countdown">Redirecting in <span id="countdown">5</span> seconds...</div>
            </div>
        <?php else: ?>
            <form method="post" action="">
                <div class="input-group">
                    <label for="otp">Enter OTP</label>
                    <i class="fas fa-key"></i>
                    <input type="text" id="otp" name="otp" placeholder="XXXXXX" required maxlength="6" pattern="[0-9]{6}" title="Please enter a 6-digit number">
                </div>
                
                <button type="submit" name="verify" class="verify-btn">
                    <i class="fas fa-check-circle"></i> Verify OTP
                </button>
            </form>
        <?php endif; ?>
    </div>

    <script>
        // Auto-focus on OTP input
        document.getElementById('otp')?.focus();
        
        // Auto-tab between OTP digits (if using multiple inputs)
        const otpInput = document.getElementById('otp');
        if (otpInput) {
            otpInput.addEventListener('input', function() {
                if (this.value.length === 6) {
                    this.blur();
                    document.querySelector('.verify-btn').focus();
                }
            });
        }
        
        // Add interactive effects to input fields
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.querySelector('i').style.color = '#ff6b6b';
                input.parentElement.querySelector('i').style.transform = 'scale(1.2)';
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.querySelector('i').style.color = '#5e72e4';
                input.parentElement.querySelector('i').style.transform = 'scale(1)';
            });
        });
        
        // Countdown timer for redirect
        <?php if (!empty($success_message)): ?>
            let seconds = 5;
            const countdownElement = document.getElementById('countdown');
            
            const countdown = setInterval(function() {
                seconds--;
                countdownElement.textContent = seconds;
                
                if (seconds <= 0) {
                    clearInterval(countdown);
                    window.location.href = 'index.php';
                }
            }, 1000);
        <?php endif; ?>
    </script>
</body>
</html>
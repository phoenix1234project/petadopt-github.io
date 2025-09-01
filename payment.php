<?php
include "config.php";

// For demo purposes, set a pet name (replace with real data later)
$pet_name = "YOUR BESTFRIEND";

if (isset($_POST['pay'])) {
    $amount = $_POST['amount'];
    $_SESSION['otp'] = rand(100000, 999999); // Generate 6-digit OTP
    $_SESSION['amount'] = $amount;
    $_SESSION['pet_name'] = $pet_name;

    // In real-world, you'd send this OTP via SMS or Email
    echo "<script>alert('Your OTP is: " . $_SESSION['otp'] . "'); window.location='verify_otp.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Pet Adoption Center</title>
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

        .payment-container {
            width: 500px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            padding: 40px;
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
        }

        .logo i {
            margin-right: 12px;
            font-size: 36px;
        }

        h2 {
            color: #2d3748;
            margin-bottom: 5px;
            font-size: 30px;
            font-weight: 700;
            text-align: center;
        }

        .subtitle {
            color: #718096;
            margin-bottom: 30px;
            font-size: 16px;
            text-align: center;
        }

        .pet-info {
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #5e72e4;
        }

        .pet-info h3 {
            color: #5e72e4;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .pet-info h3 i {
            margin-right: 10px;
        }

        .pet-info .amount {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            margin: 15px 0;
        }

        .pet-info .amount-note {
            color: #718096;
            font-size: 14px;
        }

        .payment-form {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group .input-with-icon {
            position: relative;
        }

        .form-group .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 18px;
            transition: all 0.3s;
        }

        .form-group input {
            width: 100%;
            padding: 16px 16px 16px 45px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
            background: #f7fafc;
            color: #2d3748;
        }

        .form-group input:focus {
            border-color: #5e72e4;
            box-shadow: 0 0 0 4px rgba(94, 114, 228, 0.1);
            outline: none;
            background: white;
        }

        .form-group input:focus + i {
            color: #5e72e4;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .pay-btn {
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

        .pay-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .pay-btn:hover:before {
            left: 100%;
        }

        .pay-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(94, 114, 228, 0.6);
        }

        .pay-btn:active {
            transform: translateY(1px);
        }

        .pay-btn i {
            margin-right: 10px;
        }

        .payment-methods {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
        }

        .payment-method {
            width: 60px;
            height: 40px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .payment-method i {
            font-size: 24px;
            color: #4a5568;
        }

        .secure-note {
            text-align: center;
            margin-top: 20px;
            color: #718096;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .secure-note i {
            margin-right: 8px;
            color: #38a169;
        }

        @media (max-width: 550px) {
            .payment-container {
                width: 90%;
                padding: 30px 20px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .pet-info .amount {
                font-size: 28px;
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
    
    <div class="payment-container">
        <div class="logo">
            <i class="fas fa-paw"></i>
            <span>Pet Adoption Center</span>
        </div>
        
        <h2>Adoption Payment</h2>
        <p class="subtitle">Complete your pet adoption process</p>
        
        <div class="pet-info">
            <h3><i class="fas fa-paw"></i> Adopting: <?php echo htmlspecialchars($pet_name); ?></h3>
            <div class="amount">₹5,000</div>
            <p class="amount-note">Adoption fee includes vaccination, microchipping, and starter kit</p>
        </div>
        
        <form method="post" class="payment-form">
            <div class="form-group">
                <label>Card Number</label>
                <div class="input-with-icon">
                    <i class="fas fa-credit-card"></i>
                    <input type="text" name="card_number" required placeholder="XXXX XXXX XXXX XXXX" pattern="[0-9\s]{16,19}" maxlength="19">
                </div>
            </div>
            
            <div class="form-group">
                <label>Card Holder Name</label>
                <div class="input-with-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" name="card_name" required placeholder="your name">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Expiry Date</label>
                    <div class="input-with-icon">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="text" name="expiry" required placeholder="MM/YY" pattern="(0[1-9]|1[0-2])\/([0-9]{2})" maxlength="5">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>CVV</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="cvv" required placeholder="XXX" pattern="[0-9]{3,4}" maxlength="4">
                    </div>
                </div>
            </div>
            
            <input type="hidden" name="amount" value="5000">
            
            <button type="submit" name="pay" class="pay-btn">
                <i class="fas fa-lock"></i> Pay Now
            </button>
        </form>
        
        <div class="payment-methods">
            <div class="payment-method">
                <i class="fab fa-cc-visa"></i>
            </div>
            <div class="payment-method">
                <i class="fab fa-cc-mastercard"></i>
            </div>
            <div class="payment-method">
                <i class="fab fa-cc-amex"></i>
            </div>
            <div class="payment-method">
                <i class="fab fa-cc-paypal"></i>
            </div>
        </div>
        
        <div class="secure-note">
            <i class="fas fa-shield-alt"></i>
            <span>Your payment is secure and encrypted</span>
        </div>
    </div>

    <script>
        // Format card number input
        document.querySelector('input[name="card_number"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                value = value.match(/.{1,4}/g).join(' ');
            }
            e.target.value = value;
        });

        // Format expiry date input
        document.querySelector('input[name="expiry"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });

        // Auto-advance to next input on max length
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.length == this.maxLength) {
                    const nextInput = this.nextElementSibling;
                    if (nextInput && nextInput.tagName === 'INPUT') {
                        nextInput.focus();
                    }
                }
            });
        });
    </script>
</body>
</html>
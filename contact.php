<?php
session_start();
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    // Basic validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($subject)) {
        $errors[] = "Subject is required";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If no errors, process the form (in a real application, you would send an email or save to database)
    if (empty($errors)) {
        $success = "Thank you for your message! We'll get back to you soon.";
        // Here you would typically send an email or save to database
        // mail($to, $subject, $message, $headers);
        
        // Clear form fields
        $name = $email = $subject = $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Pet Adoption Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 50%, #d9e1ec 100%);
            color: #2d3748;
            line-height: 1.6;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 40%;
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            z-index: -1;
            border-radius: 0 0 30px 30px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            border-radius: 0 0 15px 15px;
            margin: 0 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 25px;
            margin: 0;
            padding: 0;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .navbar ul li a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .navbar ul li a.active {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .page-title {
            text-align: center;
            color: white;
            margin-bottom: 40px;
            font-size: 36px;
            position: relative;
            padding-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, #63b3ed, #4299e1);
            border-radius: 2px;
        }

        .contact-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 40px;
        }

        .contact-info {
            flex: 1;
            min-width: 300px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .contact-info h2 {
            color: #2d3748;
            margin-bottom: 20px;
            font-size: 24px;
            position: relative;
            padding-bottom: 10px;
        }

        .contact-info h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #63b3ed, #4299e1);
            border-radius: 2px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            padding: 15px;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(237, 242, 247, 0.5);
        }

        .info-item:hover {
            background: rgba(237, 242, 247, 0.9);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .info-icon {
            font-size: 24px;
            color: #4299e1;
            margin-right: 15px;
            min-width: 30px;
            text-align: center;
            background: rgba(66, 153, 225, 0.1);
            padding: 10px;
            border-radius: 50%;
        }

        .info-content h3 {
            margin-bottom: 5px;
            color: #2d3748;
        }

        .info-content p {
            color: #4a5568;
        }

        .contact-form {
            flex: 1;
            min-width: 300px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .contact-form h2 {
            color: #2d3748;
            margin-bottom: 20px;
            font-size: 24px;
            position: relative;
            padding-bottom: 10px;
        }

        .contact-form h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #63b3ed, #4299e1);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
            background: rgba(237, 242, 247, 0.5);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
            outline: none;
            background: white;
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(to right, #4299e1, #3182ce);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 0 4px 6px rgba(66, 153, 225, 0.2);
        }

        .submit-btn:hover {
            background: linear-gradient(to right, #3182ce, #2b6cb0);
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(66, 153, 225, 0.3);
        }

        .alert {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-error {
            background: #fed7d7;
            color: #c53030;
            border-left: 4px solid #e53e3e;
        }

        .alert-success {
            background: #c6f6d5;
            color: #2f855a;
            border-left: 4px solid #38a169;
        }

        .map-container {
            margin-top: 40px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 12px;
        }

        footer {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            color: white;
            text-align: center;
            padding: 30px;
            margin-top: 50px;
            border-radius: 30px 30px 0 0;
        }

        .footer-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icons a {
            color: white;
            margin: 0 15px;
            font-size: 22px;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .social-icons a:hover {
            color: #63b3ed;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px;
                margin: 0 10px;
            }
            
            .navbar ul {
                margin-top: 15px;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }
            
            .container {
                padding: 15px;
                margin: 20px 10px;
            }
            
            .page-title {
                font-size: 28px;
            }
            
            .contact-info, .contact-form {
                padding: 20px;
            }
        }

        /* Decorative elements */
        .decoration {
            position: absolute;
            z-index: -1;
        }

        .decoration.circle-1 {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(66, 153, 225, 0.1) 0%, rgba(66, 153, 225, 0.05) 100%);
            top: 10%;
            left: 5%;
        }

        .decoration.circle-2 {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(66, 153, 225, 0.1) 0%, rgba(66, 153, 225, 0.05) 100%);
            bottom: 20%;
            right: 5%;
        }

        .decoration.circle-3 {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(66, 153, 225, 0.1) 0%, rgba(66, 153, 225, 0.05) 100%);
            top: 40%;
            right: 15%;
        }
    </style>
</head>
<body>
    <!-- Decorative elements -->
    <div class="decoration circle-1"></div>
    <div class="decoration circle-2"></div>
    <div class="decoration circle-3"></div>

    <div class="navbar">
        <div class="logo">
            <i class="fas fa-paw"></i>
            <span>Pet Adoption Center</span>
        </div>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
            <li><a href="contact.php" class="active"><i class="fas fa-envelope"></i> Contact Us</a></li>
            <li><a href="shop.php"><i class="fas fa-shopping-cart"></i> Visit Shop</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <h1 class="page-title">Contact Us</h1>
        
        <div class="contact-container">
            <div class="contact-info">
                <h2>Get In Touch</h2>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Address</h3>
                        <p>Pet Adoption center<br>DHANSURA [383310], MODASA GUJARAT</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="info-content">
                        <h3>Phone</h3>
                        <p>9913819770<br>9530951098</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>petadoption23@gmail.com<br>support@petadoptioncenter.com</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="info-content">
                        <h3>Working Hours</h3>
                        <p>Monday - Saturday: 10AM - 6PM<br>Sunday: 11AM - 4PM</p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <h2>Send Us a Message</h2>
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-error">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($success)): ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" value="<?php echo isset($subject) ? $subject : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" required><?php echo isset($message) ? $message : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
        </div>
        
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7322.506389010773!2d73.20422027588715!3d23.36026247923839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393e2a681409bd1f%3A0x9b933e2432927b3a!2sDhansura%2C%20Gujarat%20383310!5e0!3m2!1sen!2sin!4v1719400000000!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <p>Pet Adoption Center | Made by Ekta & Kumkum | All Rights Reserved © <?php echo date("Y"); ?></p>
        </div>
    </footer>
</body>
</html>
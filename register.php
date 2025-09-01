
<?php
include "config.php";

if (isset($_POST['register'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = $_POST['password'];
    $role  = "user"; // default role

    // Password hash
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Email already registered! Please login.');</script>";
    } else {
        $sql = "INSERT INTO users (name, email, password, role) 
                VALUES ('$name', '$email', '$hashed_pass', '$role')";
        if ($conn->query($sql)) {
            echo "<script>alert('Registration successful! Please login.');</script>";
            header("Refresh:0; url=login.php");
        } else {
            echo "<script>alert('Error: Could not register.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://images.unsplash.com/photo-1560807707-8cc77767d783') no-repeat center center/cover;
            margin: 0;
            padding: 0;
        }
        .register-container {
            width: 380px;
            background: rgba(255, 255, 255, 0.92);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.3);
            text-align: center;
            margin: 80px auto;
        }
        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .register-container input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #aaa;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }
        .register-container input:focus {
            border-color: #ff6600;
            box-shadow: 0 0 8px rgba(255, 102, 0, 0.5);
        }
        .register-container button {
            width: 95%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #ff6600;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }
        .register-container button:hover {
            background: #e65c00;
        }
        .register-container a {
            display: block;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }
        .register-container a:hover {
            color: #ff6600;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>User Register</h2>
        <form method="post">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>
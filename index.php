<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Adoption Center</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: #f8f9fa;
      color: #333;
      line-height: 1.6;
    }

    /* Rounded Gray Navbar */
    .navbar {
      background: #6c757d;
      padding: 15px 30px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 0 0 25px 25px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      margin: 0 15px;
      position: sticky;
      top: 0;
      z-index: 100;
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

    /* Hero Section with Fixed Background */
    .hero {
      position: relative;
      width: 100%;
      height: 90vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      overflow: hidden;
      margin: 20px 0;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('https://images.unsplash.com/photo-1568572933382-74d440642117?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1600&q=80') no-repeat center center/cover;
      z-index: -1;
    }

    .hero::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: -1;
    }

    .hero-content {
      color: white;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
      max-width: 800px;
      padding: 30px;
      background: rgba(0, 119, 204, 0.7);
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .hero-content h1 {
      font-size: 48px;
      margin-bottom: 20px;
    }

    .hero-content p {
      font-size: 20px;
      margin-bottom: 30px;
    }

    .btn {
      display: inline-block;
      padding: 14px 35px;
      background: #ff6b6b;
      color: white;
      text-decoration: none;
      border-radius: 50px;
      font-weight: bold;
      font-size: 18px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    }

    .btn:hover {
      background: #ff5252;
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(255, 107, 107, 0.6);
    }

    /* Container */
    .container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 20px;
    }

    /* Filter */
    .filter-bar {
      text-align: center;
      margin-bottom: 30px;
      background: white;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .filter-bar h2 {
      margin-bottom: 15px;
      color: #0077cc;
    }

    .filter-bar select {
      padding: 12px 25px;
      border-radius: 50px;
      border: 2px solid #0077cc;
      font-size: 16px;
      outline: none;
      cursor: pointer;
    }

    /* Pet Grid */
    .pet-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 25px;
      margin-top: 30px;
    }

    .pet-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .pet-card:hover {
      transform: translateY(-10px);
    }

    .pet-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-bottom: 4px solid #0077cc;
    }

    .pet-card-content {
      padding: 20px;
    }

    .pet-card h3 {
      margin: 10px 0;
      color: #0077cc;
      font-size: 22px;
    }

    .pet-card p {
      margin: 8px 0;
      color: #666;
    }

    .adopt-btn {
      display: inline-block;
      margin: 15px 0;
      padding: 10px 25px;
      background: #0077cc;
      color: white;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .adopt-btn:hover {
      background: #005fa3;
      transform: scale(1.05);
    }

    /* Footer */
    footer {
      background: #6c757d;
      color: white;
      text-align: center;
      padding: 25px;
      margin-top: 50px;
      border-radius: 25px 25px 0 0;
    }

    .social-icons {
      margin: 15px 0;
    }

    .social-icons a {
      color: white;
      margin: 0 12px;
      font-size: 20px;
      transition: color 0.3s ease;
    }

    .social-icons a:hover {
      color: #ff6b6b;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        padding: 15px;
      }
      
      .navbar ul {
        margin-top: 15px;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
      }
      
      .hero-content h1 {
        font-size: 32px;
      }
      
      .hero-content p {
        font-size: 18px;
      }
      
      .btn {
        padding: 12px 25px;
      }
      
      .pet-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

<!-- Rounded Gray Navbar -->

<div class="navbar">
  <div class="logo">
    <i class="fas fa-paw"></i>
    <span>Pet Adoption Center</span>
  </div>
  <ul>
    <li><a href="adminlogin.php"><i class="fa-solid fa-user-shield"></i>Admin</a></li>
    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
    <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a></li>
    <li><a href="shop.php"><i class="fas fa-shopping-cart"></i> Visit Shop</a></li>
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
   
  </ul>
</div>

<!-- Hero Section with Fixed Background -->
<section class="hero">
  <div class="hero-content">
    <h1>Find Your Perfect Pet Companion 🐶🐱</h1>
    <p>Adopt, don't shop! Give a loving home to pets in need.</p>
    <a href="pets.php" class="btn">Adopt Now</a>
  </div>
</section>

<!-- Main Container -->
<div class="container">

  <!-- Search Filter -->
  <div class="filter-bar">
    <h2>Find Your Perfect Pet</h2>
    <form method="get">
      <label for="type">Filter by Type:</label>
      <select name="type" onchange="this.form.submit()">
        <option value="">All Pets</option>
        <option value="Dog">Dogs</option>
        <option value="Cat">Cats</option>
        <option value="Bird">Birds</option>
        <option value="Rabbit">Rabbits</option>
      </select>
    </form>
  </div>

  <!-- Pets Grid -->
  <div class="pet-grid">
    <!-- Pet 1 -->
    <div class="pet-card">
      <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Golden Retriever">
      <div class="pet-card-content">
        <h3>Max</h3>
        <p><i class="fas fa-dog"></i> Type: Dog</p>
        <p><i class="fas fa-birthday-cake"></i> Age: 2 years</p>
        <p>Friendly and playful Golden Retriever. Loves children and other pets.</p>
        <a href='payment.php' class='adopt-btn'>Adopt Now</a>
      </div>
    </div>

    <!-- Pet 2 -->
    <div class="pet-card">
      <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Cat">
      <div class="pet-card-content">
        <h3>Luna</h3>
        <p><i class="fas fa-cat"></i> Type: Cat</p>
        <p><i class="fas fa-birthday-cake"></i> Age: 1.5 years</p>
        <p>Gentle and affectionate. Loves cuddles and playing with toys.</p>
        <a href='payment.php' class='adopt-btn'>Adopt Now</a>
      </div>
    </div>

    <!-- Pet 3 -->
    <div class="pet-card">
      <img src="https://images.unsplash.com/photo-1592194996308-7b43878e84a6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Rabbit">
      <div class="pet-card-content">
        <h3>Snowball</h3>
        <p><i class="fas fa-paw"></i> Type: Rabbit</p>
        <p><i class="fas fa-birthday-cake"></i> Age: 8 months</p>
        <p>Adorable and fluffy white rabbit. Loves carrots and hopping around.</p>
        <a href='payment.php' class='adopt-btn'>Adopt Now</a>
      </div>
    </div>

    <!-- Pet 4 -->
    <div class="pet-card">
      <img src="https://images.unsplash.com/photo-1528154291023-a6525fabe5b4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Parrot">
      <div class="pet-card-content">
        <h3>Rio</h3>
        <p><i class="fas fa-dove"></i> Type: Parrot</p>
        <p><i class="fas fa-birthday-cake"></i> Age: 3 years</p>
        <p>Colorful and intelligent. Can mimic words and loves attention.</p>
        <a href='payment.php' class='adopt-btn'>Adopt Now</a>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
  <div class="social-icons">
    <a href="#"><i class="fab fa-facebook"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-youtube"></i></a>
  </div>
  <p>Pet Adoption Center | Made by Ekta & Kumkum | All Rights Reserved © 2023</p>
</footer>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Shop - Pet Adoption Center</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(135deg, #87CEEB 0%, #B0E0E6 50%, #E0F7FA 100%);
      color: #2c3e50;
      line-height: 1.6;
      min-height: 100vh;
    }

    .navbar {
      background: #4a5568;
      padding: 15px 30px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      position: sticky;
      top: 0;
      z-index: 100;
      border-radius: 0 0 20px 20px;
      margin: 0 15px;
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
      padding: 10px 18px;
      border-radius: 25px;
      transition: all 0.3s ease;
    }

    .navbar ul li a:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-2px);
    }

    .navbar ul li a.active {
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 20px;
    }

    .page-title {
      text-align: center;
      color: #2c5282;
      margin-bottom: 40px;
      font-size: 36px;
      position: relative;
      padding-bottom: 15px;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .page-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 120px;
      height: 4px;
      background: linear-gradient(to right, #4299e1, #48bb78);
      border-radius: 2px;
    }

    .shop-info {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      margin-bottom: 40px;
      text-align: center;
      backdrop-filter: blur(5px);
      border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .shop-info h2 {
      color: #2b6cb0;
      margin-bottom: 20px;
      font-size: 28px;
    }

    .shop-info p {
      color: #4a5568;
      font-size: 18px;
      max-width: 800px;
      margin: 0 auto;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      margin-top: 40px;
    }

    .info-card {
      background: linear-gradient(135deg, #ffffff 0%, #f7fafc 100%);
      border-radius: 15px;
      padding: 25px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.7);
    }

    .info-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .info-card i {
      font-size: 42px;
      background: linear-gradient(135deg, #4299e1, #48bb78);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 15px;
    }

    .info-card h3 {
      margin-bottom: 12px;
      color: #2d3748;
      font-weight: 600;
    }

    .info-card p {
      color: #4a5568;
      font-size: 16px;
      line-height: 1.5;
    }

    .categories {
      margin-bottom: 40px;
    }

    .categories h2 {
      text-align: center;
      color: #2b6cb0;
      margin-bottom: 30px;
      font-size: 28px;
    }

    .category-tabs {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-bottom: 30px;
    }

    .category-tab {
      padding: 12px 25px;
      background: white;
      border: 2px solid #4299e1;
      border-radius: 50px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
      color: #2b6cb0;
    }

    .category-tab:hover, .category-tab.active {
      background: linear-gradient(135deg, #4299e1, #48bb78);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(66, 153, 225, 0.3);
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
      gap: 30px;
    }

    .product-card {
      background: white;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .product-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .product-image {
      height: 200px;
      overflow: hidden;
      background: #f8fafc;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .product-image::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.1) 100%);
      z-index: 1;
    }

    .product-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .product-card:hover .product-image img {
      transform: scale(1.1);
    }

    .product-info {
      padding: 25px;
    }

    .product-info h3 {
      margin-bottom: 12px;
      color: #2d3748;
      font-weight: 600;
    }

    .product-info p {
      color: #718096;
      margin-bottom: 15px;
      font-size: 15px;
      line-height: 1.5;
    }

    .product-price {
      font-size: 22px;
      font-weight: bold;
      color: #2b6cb0;
      margin-bottom: 20px;
    }

    .add-to-cart {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #4299e1, #48bb78);
      color: white;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(66, 153, 225, 0.3);
    }

    .add-to-cart:hover {
      background: linear-gradient(135deg, #3182ce, #38a169);
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(66, 153, 225, 0.4);
    }

    .testimonials {
      background: linear-gradient(135deg, rgba(224, 247, 250, 0.9) 0%, rgba(176, 224, 230, 0.9) 100%);
      border-radius: 20px;
      padding: 40px;
      margin-top: 50px;
      backdrop-filter: blur(5px);
      border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .testimonials h2 {
      text-align: center;
      color: #2b6cb0;
      margin-bottom: 30px;
      font-size: 28px;
    }

    .testimonial-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 30px;
    }

    .testimonial-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
    }

    .testimonial-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .testimonial-text {
      font-style: italic;
      margin-bottom: 20px;
      color: #4a5568;
      line-height: 1.6;
      font-size: 16px;
    }

    .testimonial-author {
      font-weight: 600;
      color: #2b6cb0;
      text-align: right;
    }

    footer {
      background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
      color: white;
      text-align: center;
      padding: 30px;
      margin-top: 50px;
      border-radius: 20px 20px 0 0;
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
      color: #a0d2eb;
      transform: translateY(-3px);
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        padding: 15px;
        margin: 0 10px;
        border-radius: 0 0 15px 15px;
      }
      
      .navbar ul {
        margin-top: 15px;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
      }
      
      .container {
        padding: 20px;
        margin: 20px 10px;
      }
      
      .page-title {
        font-size: 28px;
      }
      
      .products-grid {
        grid-template-columns: 1fr;
      }
      
      .shop-info {
        padding: 25px;
      }
      
      .info-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

<div class="navbar">
  <div class="logo">
    <i class="fas fa-paw"></i>
    <span>Pet Adoption Center</span>
  </div>
  <ul>
    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
    <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a></li>
    <li><a href="shop.php" class="active"><i class="fas fa-shopping-cart"></i> Visit Shop</a></li>
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
  </ul>
</div>

<div class="container">
  <h1 class="page-title">Pet Supplies Shop</h1>
  
  <div class="shop-info">
    <h2>Welcome to Our Pet Store</h2>
    <p>Find everything you need for your furry friends - from premium food to fun toys and accessories.</p>
    
    <div class="info-grid">
      <div class="info-card">
        <i class="fas fa-map-marker-alt"></i>
        <h3>Store Location</h3>
        <p>Ekta & Kumkum Pet Store, Ahmedabad, Gujarat</p>
      </div>
      
      <div class="info-card">
        <i class="fas fa-clock"></i>
        <h3>Opening Hours</h3>
        <p>Mon - Sat: 10 AM - 8 PM<br>Sunday: 11 AM - 4 PM</p>
      </div>
      
      <div class="info-card">
        <i class="fas fa-truck"></i>
        <h3>Free Delivery</h3>
        <p>On orders above ₹999 within Ahmedabad</p>
      </div>
      
      <div class="info-card">
        <i class="fas fa-phone"></i>
        <h3>Contact Us</h3>
        <p>+91 98765 43210<br>shop@petadoption.com</p>
      </div>
    </div>
  </div>
  
  <div class="categories">
    <h2>Shop by Category</h2>
    
    <div class="category-tabs">
      <div class="category-tab active">All Products</div>
      <div class="category-tab">Dog Supplies</div>
      <div class="category-tab">Cat Supplies</div>
      <div class="category-tab">Food & Treats</div>
      <div class="category-tab">Toys</div>
      <div class="category-tab">Accessories</div>
    </div>
    
    <div class="products-grid">
      <div class="product-card">
        <div class="product-image">
          <img src="https://images.unsplash.com/photo-1589923188937-cb64779f4abe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Premium Dog Food">
        </div>
        <div class="product-info">
          <h3>Premium Dog Food</h3>
          <p>High-quality nutrition for your furry friend</p>
          <div class="product-price">₹899</div>
          <button class="add-to-cart">Add to Cart</button>
        </div>
      </div>
      
      <div class="product-card">
        <div class="product-image">
          <img src="https://images.unsplash.com/photo-1591946614726-90d2fa9f5f5a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Cat Toy Set">
        </div>
        <div class="product-info">
          <h3>Cat Toy Set</h3>
          <p>Interactive toys to keep your cat entertained</p>
          <div class="product-price">₹499</div>
          <button class="add-to-cart">Add to Cart</button>
        </div>
      </div>
      
      <div class="product-card">
        <div class="product-image">
          <img src="https://images.unsplash.com/photo-1591886800240-0a12b0a92a5a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Dog Leash">
        </div>
        <div class="product-info">
          <h3>Premium Dog Leash</h3>
          <p>Durable and comfortable leash for daily walks</p>
          <div class="product-price">₹649</div>
          <button class="add-to-cart">Add to Cart</button>
        </div>
      </div>
      
      <div class="product-card">
        <div class="product-image">
          <img src="https://images.unsplash.com/photo-1559715544-2e56dbb5cc6a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Cat Tree">
        </div>
        <div class="product-info">
          <h3>Cat Tree House</h3>
          <p>Multi-level activity center for your feline friend</p>
          <div class="product-price">₹2,499</div>
          <button class="add-to-cart">Add to Cart</button>
        </div>
      </div>
      
      <div class="product-card">
        <div class="product-image">
          <img src="https://images.unsplash.com/photo-1596461404969-9d6c0f723cc4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Pet Bowl">
        </div>
        <div class="product-info">
          <h3>Stainless Steel Bowl</h3>
          <p>Easy to clean, non-slip pet food bowl</p>
          <div class="product-price">₹349</div>
          <button class="add-to-cart">Add to Cart</button>
        </div>
      </div>
      
      <div class="product-card">
        <div class="product-image">
          <img src="https://images.unsplash.com/photo-1583337130410-5c607d1c0c6b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Dog Bed">
        </div>
        <div class="product-info">
          <h3>Orthopedic Dog Bed</h3>
          <p>Comfortable sleeping space for your pet</p>
          <div class="product-price">₹1,799</div>
          <button class="add-to-cart">Add to Cart</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="testimonials">
    <h2>What Our Customers Say</h2>
    
    <div class="testimonial-grid">
      <div class="testimonial-card">
        <p class="testimonial-text">"The quality of products at this store is exceptional. My dog loves the food and toys I bought here!"</p>
        <p class="testimonial-author">- Rajesh K., Ahmedabad</p>
      </div>
      
      <div class="testimonial-card">
        <p class="testimonial-text">"Great prices and fast delivery. Will definitely shop here again for all my pet needs."</p>
        <p class="testimonial-author">- Priya M., Gandhinagar</p>
      </div>
      
      <div class="testimonial-card">
        <p class="testimonial-text">"The staff is very knowledgeable and helped me choose the right food for my cat with allergies."</p>
        <p class="testimonial-author">- Amit S., Ahmedabad</p>
      </div>
    </div>
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
    <p>Pet Adoption Center | Made by Ekta & Kumkum | All Rights Reserved © <?= date("Y") ?></p>
  </div>
</footer>

<script>
  // Simple category tab functionality
  document.querySelectorAll('.category-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      // In a real application, you would filter products here
    });
  });
  
  // Add to cart functionality
  document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', () => {
      const product = button.closest('.product-card');
      const productName = product.querySelector('h3').textContent;
      alert(`Added ${productName} to your cart!`);
    });
  });
</script>

</body>
</html>
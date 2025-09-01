<?php
 include "config.php";

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Content in 3 languages
$content = [
    'en' => [
        'title' => 'About Our Pet Adoption Center',
        'mission' => 'Our Mission',
        'mission_text' => 'To find loving forever homes for abandoned and rescued pets while promoting responsible pet ownership through education and community outreach.',
        'vision' => 'Our Vision',
        'vision_text' => 'A world where every pet has a loving home and no animal suffers from neglect or abandonment.',
        'story' => 'Our Story',
        'story_text' => 'Founded in 2015, we started as a small group of animal lovers rescuing pets from streets. Today, we have helped over 5,000 pets find their forever homes.',
        'team' => 'Our Team',
        'team_text' => 'Our dedicated team of veterinarians, caregivers, and volunteers work tirelessly to ensure every pet receives the love and care they deserve.',
        'choose_lang' => 'Choose Language:',
        'home' => 'Home',
        'about' => 'About Us',
        'contact' => 'Contact Us',
        'shop' => 'Visit Shop',
        'logout' => 'Logout',
    ],
    'hi' => [
        'title' => 'हमारे पालतू गोद लेने केंद्र के बारे में',
        'mission' => 'हमारा मिशन',
        'mission_text' => 'प्यार भरे स्थायी घरों को खोजना और शिक्षा और सामुदायिक आउटरीच के माध्यम से जिम्मेदार पालतू स्वामित्व को बढ़ावा देना।',
        'vision' => 'हमारी दृष्टि',
        'vision_text' => 'एक ऐसी दुनिया जहाँ हर पालतू जानवर का एक प्यारा घर हो और कोई भी जानवर उपेक्षा या परित्याग से पीड़ित न हो।',
        'story' => 'हमारी कहानी',
        'story_text' => '2015 में स्थापित, हमने सड़कों से पालतू जानवरों को बचाने वाले जानवरों के प्रेमियों के एक छोटे समूह के रूप में शुरुआत की। आज, हमने 5,000 से अधिक पालतू जानवरों को उनके स्थायी घर खोजने में मदद की है।',
        'team' => 'हमारी टीम',
        'choose_lang' => 'भाषा चुनें:',
        'home' => 'होम',
        'about' => 'हमारे बारे में',
        'contact' => 'संपर्क करें',
        'shop' => 'दुकान पर जाएं',
        'logout' => 'लॉगआउट',
    ],
    'gu' => [
        'title' => 'અમારા પાલતુ દત્તક કેન્દ્ર વિશે',
        'mission' => 'અમારા મિશન',
        'mission_text' => 'શિક્ષણ અને સમુદાય આઉટરીચ દ્વારા જવાબદાર પાલતુ માલિકીને પ્રોત્સાહન આપતી વખતે પરિત્યક્ત અને બચાવેલા પાલતુઓ માટે પ્યારા કાયમી ઘરો શોધવા.',
        'vision' => 'અમારી દ્રષ્ટિ',
        'vision_text' => 'એક એવી દુનિયા જ્યાં દરેક પાલતુનું પ્યારભર્યું ઘર હોય અને કોઈ પશુ ઉપેક્ષા અથવા પરિત્યાગથી પીડિત ન હોય.',
        'story' => 'અમારી કહાની',
        'story_text' => '2015 માં સ્થાપિત, અમે શરૂઆતમાં પશુપ્રેમીઓના એક નાના સમૂહ તરીકે સડકો પરથી પાલતુઓને બચાવવાનું શરૂ કર્યું. આજે, અમે 5,000 થી વધુ પાલતુઓને તેમના કાયમી ઘરો શોધવામાં મદદ કરી છે.',
        'team' => 'અમારી ટીમ',
        'choose_lang' => 'ભાષા પસંદ કરો:',
        'home' => 'હોમ',
        'about' => 'અમારા વિશે',
        'contact' => 'અમારો સંપર્ક કરો',
        'shop' => 'દુકાન પર જાઓ',
        'logout' => 'લોગઆઉટ',
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Pet Adoption Center</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(45deg, 
        #ff9a9e, #fad0c4, #fbc2eb, #a6c1ee, 
        #c2e9fb, #a1c4fd, #d4fc79, #96e6a1);
      background-size: 400% 400%;
      animation: gradientBackground 15s ease infinite;
      color: #333;
      line-height: 1.6;
      min-height: 100vh;
    }

    @keyframes gradientBackground {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .navbar {
      background: linear-gradient(135deg, rgba(74, 85, 104, 0.9) 0%, rgba(45, 55, 72, 0.9) 100%);
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
      backdrop-filter: blur(10px);
    }

    .navbar .logo {
      font-size: 24px;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #e2e8f0;
    }

    .navbar ul {
      list-style: none;
      display: flex;
      gap: 15px;
      margin: 0;
      padding: 0;
    }

    .navbar ul li a {
      color: #e2e8f0;
      text-decoration: none;
      font-weight: 500;
      padding: 8px 15px;
      border-radius: 20px;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.1);
    }

    .navbar ul li a:hover {
      background: rgba(255, 255, 255, 0.2);
      color: #ffffff;
    }

    .language-selector {
      text-align: center;
      margin: 20px 0;
      padding: 15px;
      background: rgba(255, 255, 255, 0.8);
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(5px);
    }

    .language-selector label {
      font-weight: 600;
      color: #2d3748;
      margin-right: 10px;
      font-size: 18px;
    }

    .language-selector select {
      padding: 12px 25px;
      border-radius: 50px;
      border: 2px solid #4a5568;
      font-size: 16px;
      outline: none;
      cursor: pointer;
      background: white;
      box-shadow: 0 4px 10px rgba(74, 85, 104, 0.2);
      transition: all 0.3s ease;
      color: #2d3748;
    }

    .language-selector select:hover {
      box-shadow: 0 6px 15px rgba(74, 85, 104, 0.3);
    }

    .container {
      max-width: 1000px;
      margin: 30px auto;
      padding: 30px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(5px);
    }

    .page-title {
      text-align: center;
      color: #2d3748;
      margin-bottom: 30px;
      font-size: 36px;
      position: relative;
      padding-bottom: 15px;
      font-weight: 700;
    }

    .page-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 4px;
      background: linear-gradient(to right, #ff6b6b, #4a5568, #2d3748, #96e6a1);
      border-radius: 2px;
    }

    .about-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }

    .about-card {
      background: linear-gradient(135deg, rgba(248, 249, 250, 0.8) 0%, rgba(233, 236, 239, 0.8) 100%);
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
      border-left: 5px solid;
      backdrop-filter: blur(5px);
    }

    .about-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .mission {
      border-color: #ff6b6b;
    }

    .vision {
      border-color: #4a5568;
    }

    .story {
      border-color: #96e6a1;
    }

    .team {
      border-color: #a6c1ee;
    }

    .about-icon {
      font-size: 40px;
      margin-bottom: 15px;
    }

    .mission .about-icon {
      color: #ff6b6b;
    }

    .vision .about-icon {
      color: #4a5568;
    }

    .story .about-icon {
      color: #96e6a1;
    }

    .team .about-icon {
      color: #a6c1ee;
    }

    .about-title {
      font-size: 24px;
      margin-bottom: 15px;
      color: #2d3748;
      font-weight: 600;
    }

    .about-content {
      color: #4a5568;
      line-height: 1.8;
      font-size: 16px;
    }

    .stats-section {
      background: linear-gradient(135deg, rgba(237, 242, 247, 0.8) 0%, rgba(226, 232, 240, 0.8) 100%);
      border-radius: 15px;
      padding: 25px;
      margin-top: 30px;
      border: 1px solid rgba(203, 213, 224, 0.5);
      backdrop-filter: blur(5px);
    }

    .stats-title {
      font-size: 24px;
      color: #2d3748;
      margin-bottom: 20px;
      text-align: center;
      font-weight: 600;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    .stat-item {
      background: rgba(255, 255, 255, 0.9);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      text-align: center;
      transition: transform 0.3s ease;
      border-bottom: 4px solid;
    }

    .stat-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-1 { border-color: #ff6b6b; }
    .stat-2 { border-color: #4a5568; }
    .stat-3 { border-color: #96e6a1; }
    .stat-4 { border-color: #a6c1ee; }

    .stat-number {
      font-size: 36px;
      font-weight: 700;
      margin-bottom: 10px;
      background: linear-gradient(45deg, #ff6b6b, #4a5568, #96e6a1);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .stat-text {
      color: #4a5568;
      font-size: 16px;
      font-weight: 500;
    }

    footer {
      background: linear-gradient(135deg, rgba(74, 85, 104, 0.9) 0%, rgba(45, 55, 72, 0.9) 100%);
      color: #e2e8f0;
      text-align: center;
      padding: 25px;
      margin-top: 50px;
      border-radius: 15px 15px 0 0;
      backdrop-filter: blur(10px);
    }

    .footer-content {
      max-width: 800px;
      margin: 0 auto;
    }

    .social-icons {
      margin: 15px 0;
    }

    .social-icons a {
      color: #e2e8f0;
      margin: 0 12px;
      font-size: 20px;
      transition: color 0.3s ease;
    }

    .social-icons a:hover {
      color: #ffffff;
    }

    .footer-content p {
      color: #cbd5e0;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        padding: 15px;
        border-radius: 0 0 15px 15px;
        margin: 0;
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
      
      .about-grid {
        grid-template-columns: 1fr;
      }
      
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 480px) {
      .stats-grid {
        grid-template-columns: 1fr;
      }
      
      .stat-number {
        font-size: 28px;
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
    <li><a href="index.php"><i class="fas fa-home"></i> <?= $content[$lang]['home'] ?></a></li>
    <li><a href="about.php"><i class="fas fa-info-circle"></i> <?= $content[$lang]['about'] ?></a></li>
    <li><a href="contact.php"><i class="fas fa-envelope"></i> <?= $content[$lang]['contact'] ?></a></li>
    <li><a href="shop.php"><i class="fas fa-shopping-cart"></i> <?= $content[$lang]['shop'] ?></a></li>
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <?= $content[$lang]['logout'] ?></a></li>
  </ul>
</div>

<div class="container">
  <div class="language-selector">
    <form method="get">
      <label for="lang"><?= $content[$lang]['choose_lang'] ?></label>
      <select name="lang" onchange="this.form.submit()">
        <option value="en" <?=($lang=="en")?"selected":""?>>English</option>
        <option value="hi" <?=($lang=="hi")?"selected":""?>>Hindi</option>
        <option value="gu" <?=($lang=="gu")?"selected":""?>>Gujarati</option>
      </select>
    </form>
  </div>

  <h1 class="page-title"><?= $content[$lang]['title'] ?></h1>
  
  <div class="about-grid">
    <div class="about-card mission">
      <div class="about-icon">
        <i class="fas fa-bullseye"></i>
      </div>
      <h2 class="about-title"><?= $content[$lang]['mission'] ?></h2>
      <p class="about-content"><?= $content[$lang]['mission_text'] ?></p>
    </div>
    
    <div class="about-card vision">
      <div class="about-icon">
        <i class="fas fa-eye"></i>
      </div>
      <h2 class="about-title"><?= $content[$lang]['vision'] ?></h2>
      <p class="about-content"><?= $content[$lang]['vision_text'] ?></p>
    </div>
    
    <div class="about-card story">
      <div class="about-icon">
        <i class="fas fa-history"></i>
      </div>
      <h2 class="about-title"><?= $content[$lang]['story'] ?></h2>
      <p class="about-content"><?= $content[$lang]['story_text'] ?></p>
    </div>
    
    <div class="about-card team">
      <div class="about-icon">
        <i class="fas fa-users"></i>
      </div>
      <h2 class="about-title"><?= $content[$lang]['team'] ?></h2>
      <p class="about-content"><?= isset($content[$lang]['team_text']) ? $content[$lang]['team_text'] : 'Our dedicated team of veterinarians, caregivers, and volunteers work tirelessly to ensure every pet receives the love and care they deserve.' ?></p>
    </div>
  </div>
  
  <div class="stats-section">
    <h2 class="stats-title"><?= ($lang=="en"?"Our Impact":($lang=="hi"?"हमारा प्रभाव":"અમારી અસર")) ?></h2>
    <div class="stats-grid">
      <div class="stat-item stat-1">
        <div class="stat-number">5,000+</div>
        <div class="stat-text"><?= ($lang=="en"?"Pets Adopted":($lang=="hi"?"पालतू गोद लिए":"પાલતુઓ દત્તક")) ?></div>
      </div>
      
      <div class="stat-item stat-2">
        <div class="stat-number">1,200+</div>
        <div class="stat-text"><?= ($lang=="en"?"Rescues":($lang=="hi"?"बचाए गए":"બચાવ")) ?></div>
      </div>
      
      <div class="stat-item stat-3">
        <div class="stat-number">200+</div>
        <div class="stat-text"><?= ($lang=="en"?"Volunteers":($lang=="hi"?"स्वयंसेवक":"સ્વયંસેવકો")) ?></div>
      </div>
      
      <div class="stat-item stat-4">
        <div class="stat-number">8</div>
        <div class="stat-text"><?= ($lang=="en"?"Years":($lang=="hi"?"साल":"વર્ષ")) ?></div>
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

</body>
</html>
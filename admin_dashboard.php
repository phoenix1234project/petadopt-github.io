<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: adminlogin.php");
    exit();
}
include('config.php');
$page_title = "Admin Dashboard";

// Stats
$stats = ['total_users'=>0,'total_orders'=>0,'total_revenue'=>0,'growth_rate'=>0];
if ($res = $conn->query("SELECT COUNT(*) AS count FROM users")) {
    $stats['total_users'] = $res->fetch_assoc()['count'];
}
if ($res = $conn->query("SELECT COUNT(*) AS count FROM adoptions")) {
    $stats['total_orders'] = $res->fetch_assoc()['count'];
}
if ($res = $conn->query("SELECT IFNULL(SUM(amount),0) AS total FROM donations")) {
    $stats['total_revenue'] = $res->fetch_assoc()['total'];
}
$growth_sql = "
    SELECT 
      (SELECT COUNT(*) FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY))
      - 
      (SELECT COUNT(*) FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 60 DAY)
        AND created_at < DATE_SUB(NOW(), INTERVAL 30 DAY)) AS growth
";
if ($res = $conn->query($growth_sql)) {
    $growth = $res->fetch_assoc()['growth'];
    $previous = $stats['total_users'] - $growth;
    if ($previous > 0) {
        $stats['growth_rate'] = round(($growth / $previous) * 100, 1);
    }
}

// Recent Activities: Fixed UNION syntax using subqueries + UNION ALL
$activities = [];
$activity_query = "
    SELECT * FROM (
        SELECT 
            'adoption' AS type,
            CONCAT('New Adoption: ', p.name, ' by ', u.name) AS description,
            a.created_at AS time
        FROM adoptions a
        JOIN pets p ON a.pet_id = p.id
        JOIN users u ON a.user_id = u.id
        ORDER BY a.created_at DESC
        LIMIT 4
    ) AS adoption_activities
  UNION ALL
    SELECT * FROM (
        SELECT 
            'donation' AS type,
            CONCAT('Donation: $', d.amount, ' from ', u.name) AS description,
            d.created_at AS time
        FROM donations d
        JOIN users u ON d.user_id = u.id
        ORDER BY d.created_at DESC
        LIMIT 4
    ) AS donation_activities
  ORDER BY time DESC
  LIMIT 4
";
if ($res = $conn->query($activity_query)) {
    while ($row = $res->fetch_assoc()) {
        $activities[] = $row;
    }
}

// Recent Adoptions Table
$orders = [];
$order_sql = "
    SELECT 
      a.id, u.name AS customer, a.created_at AS date,
      p.adoption_fee AS amount,
      CASE
        WHEN a.status = 1 THEN 'completed'
        WHEN a.status = 0 THEN 'pending'
        ELSE 'processing'
      END AS status
    FROM adoptions a
    JOIN users u ON a.user_id = u.id
    JOIN pets p ON a.pet_id = p.id
    ORDER BY a.created_at DESC
    LIMIT 5";

if ($res = $conn->query($order_sql)) {
    while ($row = $res->fetch_assoc()) {
        $orders[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($page_title) ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --info: #4895ef;
        --warning: #f72585;
        --danger: #e63946;
        --light: #f8f9fa;
        --dark: #212529;
        --gray: #6c757d;
        --sidebar-width: 250px;
        --header-height: 70px;
        --border-radius: 12px;
        --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f5f7fb;
        color: #333;
        line-height: 1.6;
    }

    .dashboard-container {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar Styles */
    .sidebar {
        width: var(--sidebar-width);
        background: linear-gradient(to bottom, var(--primary), var(--secondary));
        color: white;
        position: fixed;
        height: 100vh;
        overflow-y: auto;
        transition: var(--transition);
        z-index: 1000;
    }

    .sidebar-header {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-header h2 {
        font-size: 22px;
        margin-top: 10px;
    }

    .sidebar-menu {
        padding: 20px 0;
    }

    .menu-item {
        padding: 14px 20px;
        display: flex;
        align-items: center;
        transition: var(--transition);
        cursor: pointer;
        border-left: 4px solid transparent;
    }

    .menu-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-left: 4px solid white;
    }

    .menu-item.active {
        background-color: rgba(255, 255, 255, 0.15);
        border-left: 4px solid white;
    }

    .menu-item i {
        margin-right: 12px;
        font-size: 18px;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: var(--sidebar-width);
        transition: var(--transition);
    }

    /* Header */
    .header {
        height: var(--header-height);
        background-color: white;
        box-shadow: var(--box-shadow);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 25px;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .menu-toggle {
        display: none;
        font-size: 24px;
        cursor: pointer;
    }

    .search-box {
        display: flex;
        align-items: center;
        background-color: #f5f5f5;
        border-radius: 20px;
        padding: 8px 15px;
        width: 300px;
    }

    .search-box input {
        border: none;
        background: transparent;
        width: 100%;
        padding: 5px;
        outline: none;
    }

    .user-profile {
        display: flex;
        align-items: center;
    }

    .user-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 10px;
        background-color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }

    /* Content Area */
    .content {
        padding: 25px;
    }

    .page-title {
        font-size: 24px;
        margin-bottom: 20px;
        color: var(--dark);
    }

    /* Stats Cards */
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 20px;
        box-shadow: var(--box-shadow);
        display: flex;
        align-items: center;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-right: 15px;
    }

    .icon-1 { background-color: rgba(67, 97, 238, 0.2); color: var(--primary); }
    .icon-2 { background-color: rgba(76, 201, 240, 0.2); color: var(--success); }
    .icon-3 { background-color: rgba(247, 37, 133, 0.2); color: var(--warning); }
    .icon-4 { background-color: rgba(230, 57, 70, 0.2); color: var(--danger); }

    .stat-info h3 {
        font-size: 24px;
        margin-bottom: 5px;
    }

    .stat-info p {
        color: var(--gray);
        font-size: 14px;
    }

    /* Charts Section */
    .charts {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }

    .chart-card {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 20px;
        box-shadow: var(--box-shadow);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .chart-title {
        font-size: 18px;
        font-weight: 600;
    }

    .chart-container {
        height: 250px;
        position: relative;
    }

    /* Recent Activity */
    .recent-activity {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 20px;
        box-shadow: var(--box-shadow);
        margin-bottom: 30px;
    }

    .activity-list {
        list-style: none;
    }

    .activity-item {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
    }

    .activity-content {
        flex: 1;
    }

    .activity-content h4 {
        margin-bottom: 5px;
    }

    .activity-content p {
        color: var(--gray);
        font-size: 14px;
    }

    .activity-time {
        color: var(--gray);
        font-size: 12px;
    }

    /* Recent Table */
    .recent-table {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 20px;
        box-shadow: var(--box-shadow);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    tr:hover {
        background-color: #f8f9fa;
    }

    .status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .completed { background-color: rgba(76, 201, 240, 0.2); color: var(--success); }
    .pending { background-color: rgba(255, 193, 7, 0.2); color: #ffc107; }
    .processing { background-color: rgba(67, 97, 238, 0.2); color: var(--primary); }

    /* Footer */
    .footer {
        text-align: center;
        padding: 20px;
        color: var(--gray);
        font-size: 14px;
        border-top: 1px solid #eee;
        margin-top: 30px;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .charts {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            width: 0;
        }
        
        .sidebar.active {
            transform: translateX(0);
            width: var(--sidebar-width);
        }
        
        .main-content {
            margin-left: 0;
        }
        
        .menu-toggle {
            display: block;
        }
        
        .search-box {
            width: 200px;
        }
    }

    @media (max-width: 576px) {
        .header {
            padding: 0 15px;
        }
        
        .search-box {
            display: none;
        }
        
        .stats-cards {
            grid-template-columns: 1fr;
        }
        
        .content {
            padding: 15px;
        }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="user-img">A</div>
            <h2>Admin Panel</h2>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-item active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-paw"></i>
                <span>Pets</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                <span>Adoptions</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-donate"></i>
                <span>Donations</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <a href="logout.php" style="color: inherit; text-decoration: none;">
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Header -->
      <div class="header">
        <div class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>
        
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search...">
        </div>
        
        <div class="user-profile">
            <div class="user-img">
                <?php 
                // Display user initials
                if (isset($_SESSION['user_name'])) {
                    $names = explode(' ', $_SESSION['user_name']);
                    $initials = '';
                    foreach ($names as $name) {
                        $initials .= strtoupper(substr($name, 0, 1));
                    }
                    echo substr($initials, 0, 2);
                } else {
                    echo 'A'; // Admin initial
                }
                ?>
            </div>
            <div>
                <?php 
                // Display username
                echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Admin'; 
                ?>
            </div>
        </div>
      </div>

      <div class="content">
        <h1 class="page-title">Dashboard</h1>
        <!-- Stats Cards -->
        <div class="stats-cards">
          <!-- Total Users -->
          <div class="stat-card">
            <div class="stat-icon icon-1"><i class="fas fa-users"></i></div>
            <div class="stat-info">
              <h3><?= number_format($stats['total_users']) ?></h3>
              <p>Total Users</p>
            </div>
          </div>
          <!-- Total Adoptions -->
          <div class="stat-card">
            <div class="stat-icon icon-2"><i class="fas fa-paw"></i></div>
            <div class="stat-info">
              <h3><?= number_format($stats['total_orders']) ?></h3>
              <p>Total Adoptions</p>
            </div>
          </div>
          <!-- Total Donations -->
          <div class="stat-card">
            <div class="stat-icon icon-3"><i class="fas fa-dollar-sign"></i></div>
            <div class="stat-info">
              <h3>$<?= number_format($stats['total_revenue'], 2) ?></h3>
              <p>Total Donations</p>
            </div>
          </div>
          <!-- Growth Rate -->
          <div class="stat-card">
            <div class="stat-icon icon-4"><i class="fas fa-chart-line"></i></div>
            <div class="stat-info">
              <h3><?= $stats['growth_rate'] ?>%</h3>
              <p>Growth Rate</p>
            </div>
          </div>
        </div>
        
        <!-- Charts Section -->
        <div class="charts">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Adoptions Overview</h3>
                    <div class="chart-actions">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="adoptionsChart"></canvas>
                </div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">User Distribution</h3>
                    <div class="chart-actions">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="recent-activity">
          <div class="chart-header">
            <h3 class="chart-title">Recent Activity</h3>
            <div class="chart-actions"><i class="fas fa-ellipsis-v"></i></div>
          </div>
          <ul class="activity-list">
            <?php if (!empty($activities)): ?>
              <?php foreach ($activities as $act): ?>
                <li class="activity-item">
                  <div class="activity-icon" style="background-color:<?= $act['type']=='adoption'?'var(--primary)':'var(--success)' ?>;">
                    <i class="fas fa-<?= $act['type']=='adoption'?'paw':'donate' ?>"></i>
                  </div>
                  <div class="activity-content">
                    <h4><?= $act['type']=='adoption'?'New Adoption':'New Donation' ?></h4>
                    <p><?= htmlspecialchars($act['description']) ?></p>
                  </div>
                  <div class="activity-time">
                    <?= date('M j, g:i A', strtotime($act['time'])) ?>
                  </div>
                </li>
              <?php endforeach; ?>
            <?php else: ?>
              <li class="activity-item"><div class="activity-content"><p>No recent activity</p></div></li>
            <?php endif; ?>
          </ul>
        </div>
        
        <!-- Recent Adoptions Table -->
        <div class="recent-table">
          <div class="chart-header">
            <h3 class="chart-title">Recent Adoptions</h3>
            <div class="chart-actions"><i class="fas fa-ellipsis-v"></i></div>
          </div>
          <table>
            <thead>
              <tr>
                <th>Adoption ID</th><th>Customer</th><th>Date</th><th>Amount</th><th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $o): ?>
                  <tr>
                    <td>#<?= $o['id'] ?></td>
                    <td><?= htmlspecialchars($o['customer']) ?></td>
                    <td><?= date('M j, Y', strtotime($o['date'])) ?></td>
                    <td>$<?= number_format($o['amount'], 2) ?></td>
                    <td><span class="status <?= $o['status'] ?>"><?= ucfirst($o['status']) ?></span></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="5" style="text-align: center;">No recent adoptions</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        
        <!-- Footer -->
        <div class="footer">
          <p>&copy; <?= date('Y') ?> Pet Adoption Center Admin Dashboard. All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Toggle sidebar on mobile
    document.getElementById('menuToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
    });

    // Simple chart implementation with canvas (in a real app, use a charting library)
    document.addEventListener('DOMContentLoaded', function() {
        // Adoptions chart
        const adoptionsCtx = document.getElementById('adoptionsChart').getContext('2d');
        drawLineChart(adoptionsCtx, [12, 19, 15, 17, 22, 19, 25], '#4361ee');
        
        // User chart
        const userCtx = document.getElementById('userChart').getContext('2d');
        drawDoughnutChart(userCtx, [65, 25, 10], ['#4361ee', '#4cc9f0', '#f72585']);
    });

    function drawLineChart(ctx, data, color) {
        const width = ctx.canvas.width;
        const height = ctx.canvas.height;
        const maxValue = Math.max(...data);
        
        ctx.beginPath();
        ctx.lineWidth = 3;
        ctx.strokeStyle = color;
        
        data.forEach((value, index) => {
            const x = (index / (data.length - 1)) * width;
            const y = height - (value / maxValue) * height;
            
            if (index === 0) {
                ctx.moveTo(x, y);
            } else {
                ctx.lineTo(x, y);
            }
        });
        
        ctx.stroke();
    }

    function drawDoughnutChart(ctx, data, colors) {
        const total = data.reduce((acc, val) => acc + val, 0);
        let startAngle = 0;
        
        data.forEach((value, index) => {
            const sliceAngle = (value / total) * 2 * Math.PI;
            
            ctx.beginPath();
            ctx.fillStyle = colors[index];
            ctx.moveTo(ctx.canvas.width / 2, ctx.canvas.height / 2);
            ctx.arc(ctx.canvas.width / 2, ctx.canvas.height / 2, Math.min(ctx.canvas.width / 2, ctx.canvas.height / 2), startAngle, startAngle + sliceAngle);
            ctx.closePath();
            ctx.fill();
            
            startAngle += sliceAngle;
        });
        
        // Draw a white circle in the center to create the doughnut effect
        ctx.beginPath();
        ctx.fillStyle = 'white';
        ctx.arc(ctx.canvas.width / 2, ctx.canvas.height / 2, Math.min(ctx.canvas.width / 2, ctx.canvas.height / 2) / 2, 0, 2 * Math.PI);
        ctx.fill();
    }
  </script>
</body>
</html>
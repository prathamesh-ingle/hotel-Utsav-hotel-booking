<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

$customerName = $_SESSION['customer_name'];
$customer_id = (int) $_SESSION['customer_id'];

$conn = new mysqli("localhost", "root", "", "hotel_utsav");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Unseen booking notifications
$bookings_unseen = 0;
$bookingResult = $conn->query("
    SELECT id FROM bookings 
    WHERE customer_id = $customer_id 
    AND is_seen = 0 
    AND status IN ('approved','rejected','checkout')
");
if ($bookingResult) {
    $bookings_unseen = $bookingResult->num_rows;
}

// Unseen admin announcements
$admin_unseen = 0;
$adminResult = $conn->query("SELECT id FROM notifications WHERE is_active = 1");
if ($adminResult) {
    $admin_unseen = $adminResult->num_rows;
}

// Notification dot
$notifDot = ($bookings_unseen > 0 || $admin_unseen > 0)
    ? '<span class="ms-2 text-danger"><i class="fas fa-circle fa-xs"></i></span>'
    : '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <style>
    * { box-sizing: border-box; }
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f7f9fb;
    }
    .wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    .sidebar {
      width: 250px;
      background-color: #c0c0c0;
      color: #000;
      padding: 20px 15px;
      overflow-y: auto;
      position: fixed;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 1040;
      transition: left 0.3s ease-in-out;
    }
    .sidebar .logo {
      text-align: center;
      margin-bottom: 25px;
      position: relative;
    }
    .sidebar .logo img {
      width: 100px;
      border-radius: 10px;
    }
    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 22px;
      display: none;
      cursor: pointer;
    }
    .sidebar a {
      display: block;
      color: #000;
      padding: 10px 15px;
      font-size: 15px;
      text-decoration: none;
      border-radius: 6px;
      margin-bottom: 5px;
      transition: background 0.3s ease;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background-color: #ddd;
    }
    .topbar {
      height: 60px;
      background: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      padding: 0 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-left: 250px;
      position: fixed;
      top: 0;
      width: calc(100% - 250px);
      z-index: 1000;
    }
    .sidebar-toggle {
      display: none;
      font-size: 24px;
      background: none;
      border: none;
      color: #000;
    }
    .main-content {
      margin-left: 250px;
      padding: 80px 20px 20px;
      height: 100%;
      overflow-y: auto;
      width: calc(100% - 250px);
    }
    @media (max-width: 768px) {
      .sidebar { left: -270px; }
      .sidebar.active { left: 0; }
      .sidebar .close-btn { display: block; }
      .topbar {
        margin-left: 0;
        width: 100%;
      }
      .main-content {
        margin-left: 0;
        width: 100%;
        padding: 80px 15px 15px;
      }
      .sidebar-toggle { display: inline-block; }
    }
  </style>
</head>
<body>

<div class="wrapper">

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="logo">
      <span class="close-btn" onclick="toggleSidebar()">&times;</span>
      <img src="logo.png" alt="Hotel Logo">
    </div>
    <a href="customer_dash.php?page=welcome" class="<?= ($_GET['page'] ?? '') == 'welcome' ? 'active' : '' ?>">
      <i class="fas fa-home me-2"></i> Welcome Panel
    </a>
    <a href="customer_dash.php?page=book-room" class="<?= ($_GET['page'] ?? '') == 'book-room' ? 'active' : '' ?>">
      <i class="fas fa-bed me-2"></i> Book a Room
    </a>
    <a href="customer_dash.php?page=my-bookings" class="<?= ($_GET['page'] ?? '') == 'my-bookings' ? 'active' : '' ?>">
      <i class="fas fa-clipboard-list me-2"></i> My Bookings
    </a>
    <a href="customer_dash.php?page=notifications" class="<?= ($_GET['page'] ?? '') == 'notifications' ? 'active' : '' ?>">
      <i class="fas fa-bell me-2"></i> Notifications <?= $notifDot ?>
    </a>
    <a href="customer_dash.php?page=support" class="<?= ($_GET['page'] ?? '') == 'support' ? 'active' : '' ?>">
      <i class="fas fa-headset me-2"></i> Support / Contact
    </a>
    <a href="customer_dash.php?page=profile" class="<?= ($_GET['page'] ?? '') == 'profile' ? 'active' : '' ?>">
      <i class="fas fa-user-cog me-2"></i> Profile Settings
    </a>
    <a href="logout.php" class="text-danger">
      <i class="fas fa-sign-out-alt me-2"></i> Logout
    </a>
  </div>

  <!-- Topbar -->
  <div class="topbar">
    <button class="sidebar-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
    <h5 class="mb-0">Welcome, <?= htmlspecialchars($customerName) ?></h5>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <?php
      $page = $_GET['page'] ?? 'welcome';
      $allowedPages = ['welcome', 'book-room', 'my-bookings', 'profile', 'notifications', 'support'];
      if (in_array($page, $allowedPages)) {
          include $page . '.php';
      } else {
          echo "<p class='text-danger'>Page not found.</p>";
      }
    ?>
  </div>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("active");
  }
</script>

</body>
</html>

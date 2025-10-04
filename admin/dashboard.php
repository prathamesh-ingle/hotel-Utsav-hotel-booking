<?php
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "hotel_utsav");

// Fetch counts
$totalCustomers = $conn->query("SELECT COUNT(*) AS total FROM customer")->fetch_assoc()['total'];
$totalRooms = $conn->query("SELECT COUNT(*) AS total FROM rooms")->fetch_assoc()['total'];
$totalBookings = $conn->query("SELECT COUNT(*) AS total FROM bookings")->fetch_assoc()['total'];

$adminName = $_SESSION['admin_name'] ?? 'Admin';
?>
<head>
    <title>Hotel Utsav</title>
  <link rel="icon" href="bg.png" type="image/png">
</head>
<div class="container mt-4">
  <h4 class="mb-4 fw-bold text-warning"><i class="fas fa-tachometer-alt me-2"></i>Welcome, <?= htmlspecialchars($adminName) ?></h4>

  <div class="row g-4">

    <!-- Total Customers -->
    <div class="col-md-4">
      <div class="bg-white p-4 rounded shadow-sm border-start border-5 border-warning">
        <div class="d-flex align-items-center">
          <i class="fas fa-users fa-2x text-warning me-3"></i>
          <div>
            <h6 class="mb-0">Total Customers</h6>
            <h4 class="fw-bold mb-0"><?= $totalCustomers ?></h4>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Rooms -->
    <div class="col-md-4">
      <div class="bg-white p-4 rounded shadow-sm border-start border-5 border-success">
        <div class="d-flex align-items-center">
          <i class="fas fa-door-closed fa-2x text-success me-3"></i>
          <div>
            <h6 class="mb-0">Total Rooms</h6>
            <h4 class="fw-bold mb-0"><?= $totalRooms ?></h4>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Bookings -->
    <div class="col-md-4">
      <div class="bg-white p-4 rounded shadow-sm border-start border-5 border-primary">
        <div class="d-flex align-items-center">
          <i class="fas fa-calendar-check fa-2x text-primary me-3"></i>
          <div>
            <h6 class="mb-0">Total Bookings</h6>
            <h4 class="fw-bold mb-0"><?= $totalBookings ?></h4>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

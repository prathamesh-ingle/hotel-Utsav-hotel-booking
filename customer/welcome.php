<?php
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

$customerName = $_SESSION['customer_name'] ?? 'Guest';
?>
<head>
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
</head>
<div class="container mt-4">
  <div class="p-4 rounded shadow bg-white text-center border border-warning border-2">
    <h3 class="text-warning fw-bold mb-3">
      <i class="fas fa-hotel me-2"></i>Welcome to Hotel Utsav Square
    </h3>
    <p class="lead mb-1 text-dark">Dear <strong><?= htmlspecialchars($customerName) ?></strong>, we're delighted to have you!</p>
    <p class="text-muted mb-4">Experience luxury, comfort, and world-class hospitality in the heart of Latur.</p>

    <div class="row g-4">

      <!-- Book Room -->
      <div class="col-md-4">
        <div class="p-3 rounded shadow-sm border border-2 border-success bg-light h-100">
          <i class="fas fa-bed fa-2x text-success mb-2"></i>
          <h6 class="fw-bold text-success">Book a Room</h6>
          <p class="text-muted small">Reserve your room instantly with just a click.</p>
          <a href="customer_dash.php?page=book-room" class="btn btn-success btn-sm shadow-sm">Book Now</a>
        </div>
      </div>

      <!-- My Bookings -->
      <div class="col-md-4">
        <div class="p-3 rounded shadow-sm border border-2 border-warning bg-light h-100">
          <i class="fas fa-clipboard-list fa-2x text-warning mb-2"></i>
          <h6 class="fw-bold text-warning">My Bookings</h6>
          <p class="text-muted small">Review your bookings and booking status.</p>
          <a href="customer_dash.php?page=my-bookings" class="btn btn-warning text-white btn-sm shadow-sm">View Bookings</a>
        </div>
      </div>

      <!-- Support -->
      <div class="col-md-4">
        <div class="p-3 rounded shadow-sm border border-2 border-danger bg-light h-100">
          <i class="fas fa-headset fa-2x text-danger mb-2"></i>
          <h6 class="fw-bold text-danger">Need Help?</h6>
          <p class="text-muted small">Our support team is here to help you 24/7.</p>
          <a href="customer_dash.php?page=support" class="btn btn-danger btn-sm shadow-sm">Contact Support</a>
        </div>
      </div>

    </div>
  </div>
</div>

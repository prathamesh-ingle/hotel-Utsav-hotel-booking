<?php
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "hotel_utsav");
$cid = $_SESSION['customer_id'];

// Mark booking notifications as seen
$conn->query("UPDATE bookings SET is_seen = 1 WHERE customer_id = $cid AND status IN ('approved','rejected','checkout')");

// Fetch booking notifications
$stmt = $conn->prepare("SELECT * FROM bookings 
    WHERE customer_id = ? AND status IN ('approved', 'rejected', 'checkout') 
    ORDER BY booking_date DESC");
$stmt->bind_param("i", $cid);
$stmt->execute();
$bookingResult = $stmt->get_result();

// Fetch admin notifications excluding those dismissed by customer (optional)
$adminNotis = $conn->query("
    SELECT * FROM notifications 
    ORDER BY created_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f7fa;
      font-family: 'Poppins', sans-serif;
    }
    .notification-card {
      border-left: 6px solid;
      border-radius: 12px;
      padding: 15px 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      background: #fff;
      position: relative;
      transition: all 0.3s ease;
    }
    .notification-card:hover {
      transform: scale(1.01);
    }
    .approved { border-color: #28a745; }
    .rejected { border-color: #dc3545; }
    .checkout { border-color: #0dcaf0; }
    .admin { border-color: #ffc107; }

    .notification-icon {
      font-size: 1.8rem;
      margin-right: 15px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h3 class="mb-4 text-primary"><i class="fas fa-bell me-2"></i>Your Notifications</h3>

  <!-- Booking Notifications -->
  <?php if ($bookingResult->num_rows > 0): ?>
    <h5 class="mb-3">📌 Booking Updates</h5>
    <?php while ($row = $bookingResult->fetch_assoc()): ?>
      <?php
        $statusClass = '';
        $icon = '';
        $message = '';
        $bookingType = ucwords(str_replace('_', ' ', $row['booking_type']));
        $assignedNo = $row['assigned_number'] ?: 'Not Assigned';

        switch ($row['status']) {
          case 'approved':
            $statusClass = 'approved';
            $icon = 'fa-check-circle text-success';
            $message = "Your <strong>$bookingType</strong> booking has been <strong>approved</strong>. Room/Hall No: <strong>$assignedNo</strong>";
            break;
          case 'rejected':
            $statusClass = 'rejected';
            $icon = 'fa-times-circle text-danger';
            $message = "Your <strong>$bookingType</strong> booking was <strong>rejected</strong>. Please try again or contact support.";
            break;
          case 'checkout':
            $statusClass = 'checkout';
            $icon = 'fa-door-open text-info';
            $message = "You have <strong>checked out</strong> of your <strong>$bookingType</strong> booking. Thank you for staying with us!";
            break;
        }
      ?>
      <div class="notification-card <?= $statusClass ?>">
        <div class="d-flex align-items-start">
          <i class="fas <?= $icon ?> notification-icon"></i>
          <div>
            <h6 class="mb-1 text-capitalize"><?= $row['status'] ?> Notification</h6>
            <p class="mb-1"><?= $message ?></p>
            <small class="text-muted">Booking Date: <?= date('d M, Y', strtotime($row['booking_date'])) ?></small>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <div class="alert alert-info text-center">No booking notifications yet.</div>
  <?php endif; ?>

  <!-- Admin Announcements -->
  <h5 class="mt-5 mb-3 text-warning">📣 Announcements & Offers</h5>
  <?php if ($adminNotis->num_rows > 0): ?>
    <?php while ($row = $adminNotis->fetch_assoc()): ?>
      <div class="notification-card admin">
        <div class="d-flex align-items-start">
          <i class="fas fa-bullhorn text-warning notification-icon"></i>
          <div>
            <h6 class="mb-1"><?= htmlspecialchars($row['title']) ?></h6>
            <p class="mb-1"><?= nl2br(htmlspecialchars($row['message'])) ?></p>
            <?php if (!empty($row['image'])): ?>
              <img src="admin/uploads/<?= $row['image'] ?>" class="img-fluid mt-2 rounded" style="max-width: 300px;">
            <?php endif; ?>
            <small class="text-muted d-block mt-1">Posted on: <?= date('d M Y, h:i A', strtotime($row['created_at'])) ?></small>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <div class="alert alert-secondary text-center">No admin announcements at the moment.</div>
  <?php endif; ?>
</div>

</body>
</html>

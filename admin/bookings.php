<?php
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "hotel_utsav");

$actionStatus = "";

// Approve booking
if (isset($_POST['approve_booking'])) {
    $booking_id = intval($_POST['booking_id']);
    $assigned_no = $_POST['assigned_number'];

    $stmt = $conn->prepare("UPDATE bookings SET status='approved', assigned_number=? WHERE id=?");
    $stmt->bind_param("si", $assigned_no, $booking_id);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE rooms SET status='occupied' WHERE room_number=?");
    $stmt->bind_param("s", $assigned_no);
    $stmt->execute();

    $actionStatus = "approved";
}

// Reject booking
if (isset($_POST['reject_booking'])) {
    $booking_id = intval($_POST['booking_id']);

    $stmt = $conn->prepare("UPDATE bookings SET status='rejected', assigned_number=NULL WHERE id=?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();

    $actionStatus = "rejected";
}

// Checkout booking
if (isset($_POST['checkout_booking'])) {
    $booking_id = intval($_POST['booking_id']);

    // Get the assigned room number
    $stmt = $conn->prepare("SELECT assigned_number FROM bookings WHERE id=?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $stmt->bind_result($room_no);
    $stmt->fetch();
    $stmt->close();

    // Update booking status to checkout
    $stmt = $conn->prepare("UPDATE bookings SET status='checkout' WHERE id=?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();

    // Mark room as available again
    $stmt = $conn->prepare("UPDATE rooms SET status='available' WHERE room_number=?");
    $stmt->bind_param("s", $room_no);
    $stmt->execute();

    $actionStatus = "checkout";
}

// Fetch bookings
$result = $conn->query("SELECT b.*, c.full_name, c.email 
                        FROM bookings b 
                        JOIN customer c ON b.customer_id = c.id 
                        ORDER BY b.id DESC");
?>
<head>
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
</head>
<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <?php if ($actionStatus === 'approved'): ?>
    <div id="actionToast" class="toast align-items-center text-bg-success border-0 shadow" role="alert">
      <div class="d-flex">
        <div class="toast-body fw-semibold">✅ Booking approved successfully!</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  <?php elseif ($actionStatus === 'rejected'): ?>
    <div id="actionToast" class="toast align-items-center text-bg-danger border-0 shadow" role="alert">
      <div class="d-flex">
        <div class="toast-body fw-semibold">❌ Booking rejected.</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  <?php elseif ($actionStatus === 'checkout'): ?>
    <div id="actionToast" class="toast align-items-center text-bg-info border-0 shadow" role="alert">
      <div class="d-flex">
        <div class="toast-body fw-semibold">📤 Booking checked out successfully!</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  <?php endif; ?>
</div>

<div class="container px-0 mt-4">
  <div class="card shadow border-0">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>All Customer Bookings</h5>
      <small class="text-light">Manage and verify booking requests</small>
    </div>
    <div class="card-body bg-white">
      <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Type</th>
                <th>Date</th>
                <th>Status</th>
                <th>Assigned No.</th>
                <th>Message</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $i++ ?></td>
                <td>
                  <?= htmlspecialchars($row['full_name']) ?><br>
                  <small class="text-muted"><?= $row['email'] ?></small>
                </td>
                <td><?= ucwords(str_replace('_', ' ', $row['booking_type'])) ?></td>
                <td><?= date('d M, Y', strtotime($row['booking_date'])) ?></td>
                <td>
                  <?php
                    switch ($row['status']) {
                      case 'pending': $badge = 'warning'; break;
                      case 'approved': $badge = 'success'; break;
                      case 'rejected': $badge = 'danger'; break;
                      case 'checkout': $badge = 'info'; break;
                      default: $badge = 'secondary';
                    }
                    echo "<span class='badge bg-$badge px-3 py-1 text-uppercase fw-semibold'>{$row['status']}</span>";
                  ?>
                </td>
                <td><?= $row['assigned_number'] ?: '<span class="text-muted">Not Assigned</span>' ?></td>
                <td class="text-start">
                  <button class="btn btn-sm btn-outline-secondary toggle-btn" type="button" data-target="#msg<?= $row['id'] ?>">
                    <i class="fas fa-eye me-1"></i>View
                  </button>
                  <div class="message-box mt-2 d-none" id="msg<?= $row['id'] ?>">
                    <?= nl2br(htmlspecialchars($row['message'])) ?>
                  </div>
                </td>
                <td>
                  <?php if ($row['status'] == 'pending'): ?>
                    <!-- Approve -->
                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#approveModal<?= $row['id'] ?>">
                      <i class="fas fa-check-circle"></i> Approve
                    </button>

                    <!-- Reject -->
                    <button class="btn btn-sm btn-outline-danger ms-1" data-bs-toggle="modal" data-bs-target="#rejectModal<?= $row['id'] ?>">
                      <i class="fas fa-times-circle"></i> Reject
                    </button>

                    <!-- Approve Modal -->
                    <div class="modal fade" id="approveModal<?= $row['id'] ?>" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="POST">
                            <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                            <div class="modal-header bg-success text-white">
                              <h5 class="modal-title"><i class="fas fa-check me-2"></i>Approve Booking</h5>
                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                              <div class="mb-3">
                                <label class="form-label">Assign Room / Hall Number</label>
                                <input type="text" name="assigned_number" class="form-control" required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" name="approve_booking" class="btn btn-success">Approve</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- Reject Modal -->
                    <div class="modal fade" id="rejectModal<?= $row['id'] ?>" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="POST">
                            <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                            <div class="modal-header bg-danger text-white">
                              <h5 class="modal-title"><i class="fas fa-times me-2"></i>Reject Booking</h5>
                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure you want to reject this booking?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" name="reject_booking" class="btn btn-danger">Reject</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php elseif ($row['status'] == 'approved'): ?>
                    <!-- Checkout Form -->
                    <form method="POST" class="d-inline">
                      <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                      <button type="submit" name="checkout_booking" class="btn btn-sm btn-outline-info">
                        <i class="fas fa-door-open"></i> Checkout
                      </button>
                    </form>
                  <?php else: ?>
                    <span class="text-muted">-</span>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="alert alert-info text-center">
          <i class="fas fa-info-circle me-2"></i>No booking requests found.
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Scripts & Styles -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .message-box {
    background-color: #f9f9f9;
    border-left: 4px solid #ffc107;
    padding: 10px 15px;
    font-size: 14px;
    white-space: pre-wrap;
    border-radius: 5px;
    margin-top: 5px;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const toast = document.getElementById('actionToast');
    if (toast) {
      new bootstrap.Toast(toast).show();
    }

    document.querySelectorAll('.toggle-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const target = document.querySelector(btn.dataset.target);
        if (target.classList.contains('d-none')) {
          target.classList.remove('d-none');
          btn.innerHTML = '<i class="fas fa-eye-slash me-1"></i>Hide';
        } else {
          target.classList.add('d-none');
          btn.innerHTML = '<i class="fas fa-eye me-1"></i>View';
        }
      });
    });
  });
</script>

<?php
$cid = $_SESSION['customer_id'];
$conn = new mysqli("localhost", "root", "", "hotel_utsav");

// Handle booking update
$updated = false;
if (isset($_POST['update_booking'])) {
    $id = intval($_POST['booking_id']);
    $type = $_POST['booking_type'];
    $date = $_POST['booking_date'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("UPDATE bookings SET booking_type=?, booking_date=?, message=?, status='pending' WHERE id=? AND customer_id=?");
    $stmt->bind_param("sssii", $type, $date, $message, $id, $cid);
    $stmt->execute();

    $updated = true;
}

$result = $conn->query("SELECT * FROM bookings WHERE customer_id = $cid ORDER BY id DESC");
?>
<head>
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
</head>
<!-- Toast Alert -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <div id="updateToast" class="toast align-items-center text-bg-success border-0 shadow" role="alert">
    <div class="d-flex">
      <div class="toast-body fw-semibold">
        ✅ Booking updated successfully!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999"> 
  <div id="deleteToast" class="toast align-items-center text-bg-danger border-0 shadow" role="alert">
    <div class="d-flex">
      <div class="toast-body fw-semibold">
        ❌ Booking deleted successfully!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

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

  .action-btns .btn {
    margin-right: 6px;
  }

  .modal.fade .modal-dialog {
    transform: scale(0.95);
    transition: transform 0.3s ease-out;
  }

  .modal.show .modal-dialog {
    transform: scale(1);
  }
  .message-box {
  background-color: #f9f9f9;
  border-left: 4px solid #ffc107;
  padding: 10px 15px;
  font-size: 14px;
  white-space: pre-wrap;
  border-radius: 5px;
  transition: all 0.3s ease;
}

</style>

<div class="container px-0">
  <div class="card shadow border-0">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-book me-2"></i>Your Bookings</h5>
      <small class="text-muted">Manage your recent bookings</small>
    </div>
    <div class="card-body bg-white">
      <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
              <tr>
                <th>#</th>
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
                <td><?= ucwords(str_replace('_', ' ', $row['booking_type'])) ?></td>
                <td><?= date('d M, Y', strtotime($row['booking_date'])) ?></td>
                <td>
                  <?php
                    switch ($row['status']) {
                      case 'pending': $badge = 'warning'; break;
                      case 'approved': $badge = 'success'; break;
                      case 'rejected': $badge = 'danger'; break;
                      default: $badge = 'secondary';
                    }
                    echo "<span class='badge bg-$badge px-3 py-1 text-uppercase fw-semibold'>{$row['status']}</span>";
                  ?>
                </td>
                <td><?= $row['assigned_number'] ? $row['assigned_number'] : '<span class="text-muted">Not Assigned</span>' ?></td>
                <td class="text-start">
                  <button class="btn btn-sm btn-outline-secondary toggle-btn" type="button" data-target="#msg<?= $row['id'] ?>">
  <i class="fas fa-eye me-1"></i>View
</button>
<div class="message-box mt-2 d-none" id="msg<?= $row['id'] ?>">
  <?= nl2br(htmlspecialchars($row['message'])) ?>
</div>
                </td>
                <td class="action-btns">
                  <?php if ($row['status'] == 'pending'): ?>
                    <!-- Edit Button -->
                    <a class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">
                      <i class="fas fa-edit"></i>
                    </a>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
                      <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                          <form method="POST" action="customer_dash.php?page=my-bookings">
                            <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                            <div class="modal-header bg-dark text-white">
                              <h5 class="modal-title"><i class="fas fa-pen me-2"></i>Edit Booking</h5>
                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                              <div class="col-md-6">
                                <label class="form-label">Booking Type</label>
                                <select name="booking_type" class="form-select" required>
                                  <option value="room" <?= $row['booking_type'] == 'room' ? 'selected' : '' ?>>Room</option>
                                  <option value="party" <?= $row['booking_type'] == 'party' ? 'selected' : '' ?>>Party Hall</option>
                                  <option value="function" <?= $row['booking_type'] == 'function' ? 'selected' : '' ?>>Function Hall</option>
                                </select>
                              </div>

                              <div class="col-md-6">
                                <label class="form-label">Booking Date</label>
                                <input type="date" name="booking_date" value="<?= $row['booking_date'] ?>" class="form-control" required>
                              </div>

                              <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="4"><?= htmlspecialchars($row['message']) ?></textarea>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" name="update_booking" class="btn btn-warning fw-semibold"><i class="fas fa-save me-1"></i>Save</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- Delete Button -->
                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row['id'] ?>">
                      <i class="fas fa-trash-alt"></i>
                    </button>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal<?= $row['id'] ?>" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius: 16px;">
                          <div class="modal-header text-light" style="background: linear-gradient(135deg, #8b5e3c, #3e2f24);">
                            <h5 class="modal-title"><i class="fas fa-exclamation-circle me-2"></i>Confirm Cancellation</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body text-center px-4 pt-4">
                            <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                            <h5 class="fw-bold text-dark mb-2">Are you sure you want to cancel?</h5>
                            <p class="text-muted small">This will permanently remove your booking.</p>
                          </div>
                          <div class="modal-footer justify-content-center pb-4">
                            <button type="button" class="btn btn-outline-dark px-4 rounded-pill" data-bs-dismiss="modal">No, Go Back</button>
                            <a href="delete-booking.php?id=<?= $row['id'] ?>" class="btn btn-danger px-4 rounded-pill">
                              <i class="fas fa-check-circle me-1"></i> Yes, Cancel It
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
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
          <i class="fas fa-info-circle me-2"></i>You have no bookings yet. Please book now.
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php if ($updated): ?>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    const toast = new bootstrap.Toast(document.getElementById('updateToast'));
    toast.show();
  });

  
</script>
<?php endif; ?>
<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    const toast = new bootstrap.Toast(document.getElementById('deleteToast'));
    toast.show();
  });
</script>
<?php endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
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
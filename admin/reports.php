<?php
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "hotel_utsav");

$report_data = [];
$from_date = '';
$to_date = '';
$report_generated = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    $stmt = $conn->prepare("SELECT b.*, c.full_name, c.email 
        FROM bookings b 
        JOIN customer c ON b.customer_id = c.id 
        WHERE DATE(b.booking_date) BETWEEN ? AND ? 
        ORDER BY b.booking_date DESC");
    $stmt->bind_param("ss", $from_date, $to_date);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $report_data[] = $row;
    }
    $report_generated = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    .message-box {
      display: none;
      background-color: #f9f9f9;
      border-left: 4px solid #007bff;
      padding: 10px 15px;
      font-size: 14px;
      white-space: pre-wrap;
      border-radius: 5px;
      margin-top: 5px;
      text-align: left;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Generate Full Booking Report</h5>
    </div>
    <div class="card-body">
      <form method="POST" class="row g-3">
        <div class="col-md-4">
          <label class="form-label">From Date</label>
          <input type="date" name="from_date" class="form-control" value="<?= $from_date ?>" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">To Date</label>
          <input type="date" name="to_date" class="form-control" value="<?= $to_date ?>" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-filter me-1"></i>Generate Report
          </button>
        </div>
      </form>
    </div>
  </div>

  <?php if ($report_generated): ?>
    <div class="card mt-4 shadow-sm">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span>Bookings from <strong><?= htmlspecialchars($from_date) ?></strong> to <strong><?= htmlspecialchars($to_date) ?></strong></span>
        <a href="export_report.php?from=<?= $from_date ?>&to=<?= $to_date ?>" class="btn btn-light btn-sm">
          <i class="fas fa-file-excel me-1"></i>Download Excel
        </a>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-bordered align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Customer</th>
              <th>Email</th>
              <th>Type</th>
              <th>Date</th>
              <th>Status</th>
              <th>Assigned No.</th>
              <th>Message</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($report_data)): ?>
              <?php foreach ($report_data as $i => $row): ?>
                <tr>
                  <td><?= $i + 1 ?></td>
                  <td><?= htmlspecialchars($row['full_name']) ?></td>
                  <td><?= htmlspecialchars($row['email']) ?></td>
                  <td><?= ucwords(str_replace('_', ' ', $row['booking_type'])) ?></td>
                  <td><?= htmlspecialchars($row['booking_date']) ?></td>
                  <td>
                    <?php
                      $status = strtolower($row['status']);
                      switch ($status) {
                        case 'approved': $badge = 'success'; break;
                        case 'pending': $badge = 'warning'; break;
                        case 'rejected': $badge = 'danger'; break;
                        case 'checkout': $badge = 'info'; break;
                        default: $badge = 'secondary'; break;
                      }
                      echo "<span class='badge bg-$badge text-uppercase px-3'>{$status}</span>";
                    ?>
                  </td>
                  <td><?= $row['assigned_number'] ?: '<span class="text-muted">N/A</span>' ?></td>
                  <td>
                    <button class="btn btn-sm btn-outline-primary toggle-message" data-target="msg<?= $row['id'] ?>">
                      <i class="fas fa-eye"></i> View
                    </button>
                    <div id="msg<?= $row['id'] ?>" class="message-box">
                      <?= nl2br(htmlspecialchars($row['message'])) ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="8">No bookings found in selected range.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endif; ?>
</div>

<script>
  document.querySelectorAll('.toggle-message').forEach(btn => {
    btn.addEventListener('click', function () {
      const box = document.getElementById(this.getAttribute('data-target'));
      if (box.style.display === "none" || box.style.display === "") {
        box.style.display = "block";
        this.innerHTML = '<i class="fas fa-eye-slash"></i> Hide';
      } else {
        box.style.display = "none";
        this.innerHTML = '<i class="fas fa-eye"></i> View';
      }
    });
  });
</script>
</body>
</html>

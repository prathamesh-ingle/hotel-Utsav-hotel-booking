<?php
ob_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "hotel_utsav");

// Toast flags
$added = isset($_GET['added']) && $_GET['added'] == 1;
$deleted = isset($_GET['deleted']) && $_GET['deleted'] == 1;

// Add Customer
if (isset($_POST['add_customer'])) {
    $name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($name) && !empty($email) && !empty($password)) {
        $stmt = $conn->prepare("INSERT INTO customer (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
    }

    echo "<script>window.location.href = 'admin_dash.php?page=customers&added=1';</script>";
    exit();
}

// Delete Customer
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM customer WHERE id = $id");
    echo "<script>window.location.href = 'admin_dash.php?page=customers&deleted=1';</script>";
    exit();
}

// Search by Email
$searchEmail = $_GET['search_email'] ?? '';
if (!empty($searchEmail)) {
    $stmt = $conn->prepare("SELECT * FROM customer WHERE email LIKE ? ORDER BY id DESC");
    $like = "%$searchEmail%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $customers = $stmt->get_result();
} else {
    $customers = $conn->query("SELECT * FROM customer ORDER BY id DESC");
}
?>
<head>
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
</head>
<!-- Customer Management UI -->
<div class="container mt-5">
  <h3 class="mb-4">Customer Management</h3>

  <!-- Stylish Search by Email -->
<form method="GET" class="row g-2 align-items-center mb-4">
  <input type="hidden" name="page" value="customers">
  <div class="col-md-6">
    <div class="input-group shadow-sm">
      <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
      <input type="text" name="search_email" class="form-control border-start-0" placeholder="Search customer by email..." value="<?= htmlspecialchars($searchEmail) ?>">
    </div>
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn w-100 shadow-sm text-dark" style="background-color: #ffc107;">
  <i class="fas fa-filter me-1"></i> Filter
</button>
  </div>
  <div class="col-md-2">
    <a href="admin_dash.php?page=customers" class="btn btn-outline-secondary w-100 shadow-sm">
      <i class="fas fa-redo me-1"></i> Reset
    </a>
  </div>
</form>


  <!-- Add Customer Form -->
  <form method="POST" class="row g-3 mb-4">
    <div class="col-md-4">
      <input type="text" name="full_name" placeholder="Full Name" class="form-control" required>
    </div>
    <div class="col-md-3">
      <input type="email" name="email" placeholder="Email" class="form-control" required>
    </div>
    <div class="col-md-3">
      <input type="text" name="password" placeholder="Password" class="form-control" required>
    </div>
    <div class="col-md-2">
      <button type="submit" name="add_customer" class="btn btn-success w-100">Add Customer</button>
    </div>
  </form>

  <!-- Customer Table -->
  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>Full Name</th>
          <th>Email</th>
          <th>Password</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($customers->num_rows > 0): ?>
          <?php while ($row = $customers->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['full_name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['password']) ?></td>
              <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
              <td>
                <a href="admin_dash.php?page=customers&delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">
                  <i class="fas fa-trash"></i> Delete
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-danger">No customers found for "<?= htmlspecialchars($searchEmail) ?>".</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Toasts -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <?php if ($added): ?>
    <div id="addedToast" class="toast align-items-center text-bg-success border-0 shadow" role="alert">
      <div class="d-flex">
        <div class="toast-body fw-semibold">✅ Customer added successfully!</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($deleted): ?>
    <div id="deletedToast" class="toast align-items-center text-bg-danger border-0 shadow" role="alert">
      <div class="d-flex">
        <div class="toast-body fw-semibold">❌ Customer deleted successfully!</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  <?php endif; ?>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($added): ?>new bootstrap.Toast(document.getElementById('addedToast')).show();<?php endif; ?>
  <?php if ($deleted): ?>new bootstrap.Toast(document.getElementById('deletedToast')).show();<?php endif; ?>
});
</script>

<?php ob_end_flush(); ?>

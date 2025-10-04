<?php
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "hotel_utsav");

$added = $updated = false;

// Add Room
if (isset($_POST['add_room'])) {
    $room_no = $_POST['room_number'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO rooms (room_number, type, category, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $room_no, $type, $category, $price);
    $stmt->execute();
    $added = true;
}

// Update Room
if (isset($_POST['update_room'])) {
    $id = $_POST['room_id'];
    $room_no = $_POST['room_number'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE rooms SET room_number=?, type=?, status=?, category=?, price=? WHERE id=?");
    $stmt->bind_param("ssssdi", $room_no, $type, $status, $category, $price, $id);
    $stmt->execute();
    $updated = true;
}

$rooms = $conn->query("SELECT * FROM rooms ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Room Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>

<!-- TOASTS -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <div id="addedToast" class="toast align-items-center text-bg-success border-0 shadow" role="alert">
    <div class="d-flex">
      <div class="toast-body fw-semibold">✅ Room added successfully!</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>

  <div id="updatedToast" class="toast align-items-center text-bg-primary border-0 shadow" role="alert">
    <div class="d-flex">
      <div class="toast-body fw-semibold">✏️ Room updated successfully!</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>
<head>
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
</head>
<!-- ROOM MANAGEMENT -->
<div class="container my-4">
  <h3 class="mb-4 text-center">Room Management</h3>

  <!-- ADD ROOM FORM -->
  <form method="POST" class="row g-3 mb-4">
    <div class="col-md-2 col-sm-6">
      <input type="text" name="room_number" placeholder="Room No" class="form-control" required>
    </div>
    <div class="col-md-2 col-sm-6">
      <select name="type" class="form-select" required>
        <option value="">Select Type</option>
        <option value="room">Room</option>
        <option value="party">Party Hall</option>
        <option value="function">Function Hall</option>
      </select>
    </div>
    <div class="col-md-3 col-sm-6">
      <select name="category" class="form-select" required>
        <option value="">Select Category</option>
        <option value="Executive King Bed Room">Executive King Bed Room</option>
        <option value="Executive Twin Bed Room">Executive Twin Bed Room</option>
        <option value="Standard">Standard</option>
        <option value="Suite">Suite</option>
        <option value="Banquet">Banquet</option>
        <option value="Marriage Hall">Marriage Hall</option>
      </select>
    </div>
    <div class="col-md-2 col-sm-6">
      <input type="number" name="price" placeholder="Price" step="0.01" class="form-control" required>
    </div>
    <div class="col-md-3 col-sm-12">
      <button type="submit" name="add_room" class="btn btn-success w-100">Add Room</button>
    </div>
  </form>

  <!-- ROOM TABLE -->
  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>Room No</th>
          <th>Type</th>
          <th>Status</th>
          <th>Category</th>
          <th>Price</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($room = $rooms->fetch_assoc()): ?>
        <tr>
          <td><?= $room['room_number'] ?></td>
          <td><?= ucfirst($room['type']) ?></td>
          <td><?= ucfirst($room['status']) ?></td>
          <td><?= $room['category'] ?></td>
          <td>₹<?= number_format($room['price']) ?></td>
          <td><?= date('d M, Y', strtotime($room['created_at'])) ?></td>
          <td>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $room['id'] ?>">
              <i class="fas fa-edit"></i>
            </button>
          </td>
        </tr>

        <!-- EDIT MODAL -->
        <div class="modal fade" id="editModal<?= $room['id'] ?>" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <form method="POST">
                <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
                <div class="modal-header bg-dark text-white">
                  <h5 class="modal-title">Edit Room</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                  <div class="col-md-6">
                    <label>Room No</label>
                    <input type="text" name="room_number" value="<?= $room['room_number'] ?>" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label>Price</label>
                    <input type="number" name="price" value="<?= $room['price'] ?>" step="0.01" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label>Type</label>
                    <select name="type" class="form-select">
                      <option value="room" <?= $room['type'] == 'room' ? 'selected' : '' ?>>Room</option>
                      <option value="party" <?= $room['type'] == 'party' ? 'selected' : '' ?>>Party Hall</option>
                      <option value="function" <?= $room['type'] == 'function' ? 'selected' : '' ?>>Function Hall</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Status</label>
                    <select name="status" class="form-select">
                      <option value="available" <?= $room['status'] == 'available' ? 'selected' : '' ?>>Available</option>
                      <option value="occupied" <?= $room['status'] == 'occupied' ? 'selected' : '' ?>>Occupied</option>
                      <option value="maintenance" <?= $room['status'] == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label>Category</label>
                    <select name="category" class="form-select">
                      <option value="Executive King Bed Room" <?= $room['category'] == 'Executive King Bed Room' ? 'selected' : '' ?>>Executive King Bed Room</option>
                      <option value="Executive Twin Bed Room" <?= $room['category'] == 'Executive Twin Bed Room' ? 'selected' : '' ?>>Executive Twin Bed Room</option>
                      <option value="Standard" <?= $room['category'] == 'Standard' ? 'selected' : '' ?>>Standard</option>
                      <option value="Suite" <?= $room['category'] == 'Suite' ? 'selected' : '' ?>>Suite</option>
                      <option value="Banquet" <?= $room['category'] == 'Banquet' ? 'selected' : '' ?>>Banquet</option>
                      <option value="Marriage Hall" <?= $room['category'] == 'Marriage Hall' ? 'selected' : '' ?>>Marriage Hall</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" name="update_room" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($added): ?>new bootstrap.Toast(document.getElementById('addedToast')).show();<?php endif; ?>
  <?php if ($updated): ?>new bootstrap.Toast(document.getElementById('updatedToast')).show();<?php endif; ?>
});
</script>

</body>
</html>

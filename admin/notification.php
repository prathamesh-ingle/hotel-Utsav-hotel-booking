<?php
$conn = new mysqli("localhost", "root", "", "hotel_utsav");

$upload_success = false;

// Add Notification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['message']) && !isset($_POST['edit_id'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $imageName = '';

    if (!empty($_FILES['banner']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir);
        $imageName = time() . "_" . basename($_FILES["banner"]["name"]);
        move_uploaded_file($_FILES["banner"]["tmp_name"], $targetDir . $imageName);
    }

    $stmt = $conn->prepare("INSERT INTO notifications (title, message, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $message, $imageName);
    $stmt->execute();
    $upload_success = true;
}

// Delete Notification
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM notifications WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    echo "<script>window.location.href='admin_dash.php?page=notification';</script>";
    exit();
}

// Edit Notification (Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $edit_id = intval($_POST['edit_id']);
    $edit_title = $_POST['edit_title'];
    $edit_message = $_POST['edit_message'];

    $stmt = $conn->prepare("UPDATE notifications SET title = ?, message = ? WHERE id = ?");
    $stmt->bind_param("ssi", $edit_title, $edit_message, $edit_id);
    $stmt->execute();
    echo "<script>window.location.href='admin_dash.php?page=notification';</script>";
    exit();
}

// Get all notifications
$all = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC");
?>
<head>
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
</head>
<div class="container">
  <h4 class="mb-3">📢 Admin Notification Panel</h4>

  <?php if ($upload_success): ?>
    <div class="alert alert-success">Notification sent successfully!</div>
  <?php endif; ?>

  <!-- Add Notification Form -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white">Send New Notification</div>
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Message</label>
          <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Attach Image/Banner (optional)</label>
          <input type="file" name="banner" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Send Notification</button>
      </form>
    </div>
  </div>

  <!-- All Notifications -->
  <div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">📜 All Notifications</div>
    <div class="card-body">
      <?php if ($all->num_rows > 0): ?>
        <?php while ($row = $all->fetch_assoc()): ?>
          <div class="border-bottom py-3">
            <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id']): ?>
              <!-- Edit Notification -->
              <form method="POST">
                <input type="hidden" name="edit_id" value="<?= $row['id'] ?>">
                <div class="mb-2">
                  <input type="text" name="edit_title" class="form-control" value="<?= htmlspecialchars($row['title']) ?>" required>
                </div>
                <div class="mb-2">
                  <textarea name="edit_message" class="form-control" rows="4" required><?= htmlspecialchars($row['message']) ?></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-success">Update</button>
                <a href="admin_dash.php?page=notification" class="btn btn-sm btn-secondary">Cancel</a>
              </form>
            <?php else: ?>
              <!-- View Notification -->
              <h6><?= htmlspecialchars($row['title']) ?></h6>
              <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
              <?php if (!empty($row['image'])): ?>
                <img src="uploads/<?= $row['image'] ?>" class="img-thumbnail mb-2" style="max-width: 250px;">
              <?php endif; ?>
              <small class="text-muted">Posted on <?= date('d M Y, h:i A', strtotime($row['created_at'])) ?></small>
              <div class="mt-2">
                <a href="admin_dash.php?page=notification&edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="admin_dash.php?page=notification&delete_id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this notification?')">Delete</a>
              </div>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No notifications posted yet.</p>
      <?php endif; ?>
    </div>
  </div>
</div>


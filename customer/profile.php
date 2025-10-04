<?php
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "hotel_utsav");
$customer_id = $_SESSION['customer_id'];
$success = "";
$error = "";

// Fetch customer details
$stmt = $conn->prepare("SELECT full_name, email FROM customer WHERE id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$stmt->bind_result($full_name, $email);
$stmt->fetch();
$stmt->close();

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_name = trim($_POST['full_name']);
    $new_email = trim($_POST['email']);
    $new_password = $_POST['password'];

    if (empty($new_name) || empty($new_email)) {
        $error = "Name and Email cannot be empty.";
    } else {
        if (!empty($new_password)) {
            $stmt = $conn->prepare("UPDATE customer SET full_name = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param("sssi", $new_name, $new_email, $new_password, $customer_id);
        } else {
            $stmt = $conn->prepare("UPDATE customer SET full_name = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $new_name, $new_email, $customer_id);
        }

        if ($stmt->execute()) {
            $success = "✅ Profile updated successfully!";
            $full_name = $new_name;
            $email = $new_email;
        } else {
            $error = "❌ Failed to update profile.";
        }
    }
}
?>

<!-- Bootstrap and Font Awesome already included in customer_dash.php -->

<style>
    .profile-card {
        max-width: 600px;
        margin: auto;
        border-radius: 16px;
        background: white;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 30px;
        border-left: 6px solid #ffd700;
    }

    .profile-card h4 {
        font-weight: 600;
        color: #343a40;
    }

    .profile-icon {
        font-size: 2rem;
        color: #ffd700;
    }

    .form-label {
        font-weight: 500;
    }

    .btn-primary {
        background: #d4af37;
        border: none;
    }

    .btn-primary:hover {
        background: #c39b2d;
    }

    .alert-success {
        background-color: #d4edda;
        border-left: 5px solid #28a745;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-left: 5px solid #dc3545;
    }
</style>
<head>
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
</head>
<div class="container py-4">
  <div class="profile-card">
    <div class="d-flex align-items-center mb-4">
      <i class="fas fa-user-cog profile-icon me-3"></i>
      <h4 class="mb-0">Profile Settings</h4>
    </div>

    <?php if (!empty($success)): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php elseif (!empty($error)): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-3">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="full_name" class="form-control shadow-sm" value="<?= htmlspecialchars($full_name) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control shadow-sm" value="<?= htmlspecialchars($email) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">New Password</label>
        <input type="password" name="password" class="form-control shadow-sm" placeholder="Leave blank to keep current password">
      </div>

      <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Update Profile</button>
    </form>
  </div>
</div>

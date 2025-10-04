<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "hotel_utsav";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$error = "";
$signup_success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM customer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "An account with this email already exists.";
    } else {
        // Insert new customer
        $stmt = $conn->prepare("INSERT INTO customer (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $password);
        if ($stmt->execute()) {
            $_SESSION['customer_id'] = $stmt->insert_id;
            $_SESSION['customer_name'] = $full_name;
            $signup_success = true;
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@600&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom right, #141414, #1e1e1e);
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
    }
    .login-wrapper {
      position: relative;
      width: 90%;
      max-width: 420px;
      padding: 50px 40px;
      border-radius: 20px;
      overflow: hidden;
      color: white;
      box-shadow: 0 0 40px rgba(212, 210, 200, 0.16);
      background: url('bg.jpg') no-repeat center center;
      background-size: cover;
      backdrop-filter: blur(8px);
    }
    .login-wrapper::after {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(6px);
      z-index: 1;
      border-radius: 20px;
    }
    .login-wrapper > * {
      position: relative;
      z-index: 2;
    }
    .login-title {
      font-family: 'Great Vibes', cursive;
      color: #ffd700;
      font-size: 44px;
      text-align: center;
    }
    .login-subtitle {
      font-family: 'Playfair Display', serif;
      font-size: 18px;
      color: #eee;
      text-align: center;
      margin-bottom: 30px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 14px;
      padding: 14px 16px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: #fff;
    }
    .btn-login {
      background: linear-gradient(to right, #ffd700, #b8860b);
      color: #000;
      border-radius: 14px;
      padding: 13px;
      font-weight: 600;
      transition: 0.3s ease;
    }
    .btn-login:hover {
      background: linear-gradient(to right, #ffe066, #c9a500);
    }
    .switch-link {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #ccc;
    }
    .switch-link a {
      color: #ffd700;
      text-decoration: none;
    }
    .switch-link a:hover {
      text-decoration: underline;
    }
    .progress-wrapper {
      display: none;
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      width: 70%;
      text-align: center;
      z-index: 10000;
    }
    .slim-progress-track {
      width: 100%;
      height: 4px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 50px;
      overflow: hidden;
    }
    .slim-progress-fill {
      width: 0%;
      height: 100%;
      background: linear-gradient(90deg, #ffd700, #ffcc00);
      box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
      border-radius: 50px;
      transition: width 0.3s ease-in-out;
    }
    .progress-text {
      color: #ffd700;
      font-weight: bold;
      margin-top: 8px;
    }
    .error-msg {
      color: #ff4d4d;
      font-size: 14px;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<?php if ($signup_success): ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signupForm");
    form.style.display = "none";

    const progressWrapper = document.getElementById("progressWrapper");
    const progressBar = document.getElementById("progressBar");
    const progressText = document.getElementById("progressText");

    progressWrapper.style.display = "block";

    let progress = 0;
    const interval = setInterval(() => {
      progress++;
      progressBar.style.width = progress + "%";
      progressText.textContent = progress + "%";
      if (progress >= 100) {
        clearInterval(interval);
        setTimeout(() => {
          window.location.href = "customer_dashboard.php";
        }, 300);
      }
    }, 20);
  });
</script>
<?php endif; ?>

<div class="login-wrapper" id="signupForm">
  <div class="login-title">Create Account</div>
  <div class="login-subtitle">Join the luxury of Hotel Utsav Square</div>

  <?php if (!empty($error)): ?>
    <div class="error-msg"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="form-group">
      <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
    </div>
    <div class="form-group">
      <input type="email" name="email" class="form-control" placeholder="Email Address" required>
    </div>
    <div class="form-group">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-login w-100">Sign Up</button>
  </form>

  <div class="switch-link">
    Already have an account? <a href="customer_login.php">Login here</a><br>
    <a href="http://localhost/project/run/7hotelBooking/index.php" style="color:rgb(47, 140, 34)">&laquo; Go Back</a>
  </div>
</div>

<div class="progress-wrapper" id="progressWrapper">
  <div class="slim-progress-track">
    <div class="slim-progress-fill" id="progressBar"></div>
  </div>
  <div class="progress-text" id="progressText">0%</div>
</div>

</body>
</html>

<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "hotel_utsav";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$error = "";
$login_success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if ($password === $admin['password']) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username']; 
            $login_success = true;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No admin found with this username.";
    }
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
    /* same styling as customer login */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom right, #141414, #1e1e1e);
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }
    .login-wrapper {
      position: relative;
      width: 90%;
      max-width: 420px;
      padding: 50px 40px;
      border-radius: 20px;
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
    .progress-wrapper {
      display: none;
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      width: 70%;
      z-index: 10000;
      text-align: center;
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

<?php if ($login_success): ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("loginForm").style.display = "none";
    const wrapper = document.getElementById("progressWrapper");
    const bar = document.getElementById("progressBar");
    const text = document.getElementById("progressText");

    wrapper.style.display = "block";
    let progress = 0;
    const interval = setInterval(() => {
      progress++;
      bar.style.width = progress + "%";
      text.textContent = progress + "%";
      if (progress >= 100) {
        clearInterval(interval);
        setTimeout(() => {
          window.location.href = "admin_dash.php";
        }, 300);
      }
    }, 20);
  });
</script>
<?php endif; ?>

<div class="login-wrapper" id="loginForm">
  <div class="login-title">Admin Panel</div>
  <div class="login-subtitle">Welcome back to Hotel Utsav Admin Login</div>

  <?php if (!empty($error)): ?>
    <div class="error-msg"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST">
  <div class="form-group">
    <input type="text" name="username" class="form-control" placeholder="Admin Username" required>
  </div>
  <div class="form-group">
    <input type="password" name="password" class="form-control" placeholder="Password" required>
  </div>
  <button type="submit" class="btn btn-login w-100">Login</button>
</form>

  <div class="switch-link">
    <a href="http://localhost/project/run/7hotelBooking/index.php">&laquo; Go to Home</a>
  </div>
</div>

<!-- Progress -->
<div class="progress-wrapper" id="progressWrapper">
  <div class="slim-progress-track">
    <div class="slim-progress-fill" id="progressBar"></div>
  </div>
  <div class="progress-text" id="progressText">0%</div>
</div>

</body>
</html>

<?php
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "hotel_utsav");

    $cid = $_SESSION['customer_id'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $alt_phone = $_POST['alt_phone'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $message = $_POST['message'];

    $formatted_message = "Booking Type: $type\nName: $name\nPhone: $phone\nAlt Phone: $alt_phone\nEmail: $email\nGender: $gender\nAddress: $address\nGuests: $guests\nTime: $time\nPayment: $payment_method\n\nMessage: $message";

    $booking_type = in_array($type, ['Executive King Bed Room', 'Executive Twin Bed Room']) ? 'room' : strtolower(str_replace(' ', '_', $type));

    $stmt = $conn->prepare("INSERT INTO bookings (customer_id, booking_type, booking_date, message, status, contact_required) VALUES (?, ?, ?, ?, 'pending', 1)");
    $stmt->bind_param("isss", $cid, $booking_type, $date, $formatted_message);
    $stmt->execute();
    $success_msg = "✅ Booking request sent. Admin will contact you soon.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
      margin: 0;
    }
    .container {
      padding-left: 15px;
      padding-right: 15px;
    }
    .form-control, .form-select {
      border-radius: 0.375rem;
    }
    .card {
      border-radius: 0.5rem;
    }
    @media (max-width: 576px) {
      .btn {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="container my-4">
  <div class="row justify-content-center">
    <div class="col-12 col-md-11 col-lg-10">
      <div class="card shadow border-0">
        <div class="card-body bg-white">
          <?php if (!empty($success_msg)): ?>
            <div class="alert alert-success"><?= $success_msg ?></div>
          <?php endif; ?>
          <form method="POST" class="row g-3">

            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Phone Number</label>
              <input type="tel" name="phone" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Alternate Phone</label>
              <input type="tel" name="alt_phone" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control">
            </div>

            <div class="col-md-4">
              <label class="form-label">Gender</label>
              <select name="gender" class="form-select">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <div class="col-md-8">
              <label class="form-label">Address</label>
              <input type="text" name="address" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Booking Type</label>
              <select name="type" class="form-select" required>
                <optgroup label="Rooms">
                  <option value="Executive King Bed Room">Executive King Bed Room</option>
                  <option value="Executive Twin Bed Room">Executive Twin Bed Room</option>
                </optgroup>
                <optgroup label="Halls">
                  <option value="Party Hall">Party Hall</option>
                  <option value="Function Hall">Function Hall</option>
                </optgroup>
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Date</label>
              <input type="date" name="date" class="form-control" required>
            </div>

            <div class="col-md-3">
              <label class="form-label">Time</label>
              <input type="text" name="time" class="form-control" placeholder="e.g. 6 PM - 11 PM" required>
            </div>

            <div class="col-md-4">
              <label class="form-label">No. of Guests</label>
              <input type="number" name="guests" class="form-control" required>
            </div>

            <div class="col-md-4">
              <label class="form-label">Payment Method</label>
              <select name="payment_method" class="form-select">
                <option>GPay</option>
                <option>PhonePe</option>
                <option>Bank Transfer</option>
                <option>Cash on Arrival</option>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label">Special Requests</label>
              <textarea name="message" class="form-control" rows="3"></textarea>
            </div>

            <div class="col-12 text-end">
              <button type="submit" class="btn btn-warning fw-semibold px-4">
                <i class="fas fa-paper-plane me-1"></i>Send Request
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>

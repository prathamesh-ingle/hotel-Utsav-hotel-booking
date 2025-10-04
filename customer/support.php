<?php
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}
?>
<head>
    <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
</head>
<div class="container mt-4">
  <h3 class="mb-4 text-primary fw-bold">
    <i class="fas fa-headset me-2"></i>Support & Contact
  </h3>

  <div class="row g-4">

    <!-- Contact Info -->
    <div class="col-md-6">
      <div class="p-4 shadow-lg bg-light rounded border border-success border-2">
        <h5 class="text-success"><i class="fas fa-phone-alt me-2"></i>Contact Us</h5>
        <p><span class="badge bg-success me-2">Phone:</span> +91 98765 43210</p>
        <p><span class="badge bg-success me-2">Email:</span> <a href="mailto:support@hotelutsavsquare.com" class="text-decoration-none">support@hotelutsavsquare.com</a></p>
        <p><span class="badge bg-success me-2">Website:</span> <a href="https://www.hotelutsavsquare.com" target="_blank" class="text-decoration-none">www.hotelutsavsquare.com</a></p>
      </div>
    </div>

    <!-- Address / Google Maps -->
    <div class="col-md-6">
      <div class="p-4 shadow-lg bg-light rounded border border-danger border-2">
        <h5 class="text-danger"><i class="fas fa-map-marker-alt me-2"></i>Our Location</h5>
        <p>Opp. Swami Vivekanand Institute of Polytechnic,<br>M.I.D.C., Latur, Maharashtra 413512</p>
        <a href="https://www.google.com/maps?q=Hotel+Utsav+Square,+M.I.D.C.,+Latur,+Maharashtra+413512" 
   target="_blank" 
   class="btn btn-outline-primary">
  <i class="fas fa-location-arrow me-1"></i> View on Google Maps
</a>
      </div>
    </div>

    <!-- Working Hours -->
    <div class="col-md-6">
      <div class="p-4 shadow-lg bg-light rounded border border-warning border-2">
        <h5 class="text-warning"><i class="fas fa-clock me-2"></i>Working Hours</h5>
        <ul class="list-unstyled">
          <li><i class="far fa-calendar-check me-2"></i>Monday – Friday: <strong>9:00 AM – 8:00 PM</strong></li>
          <li><i class="far fa-calendar-alt me-2"></i>Saturday: <strong>10:00 AM – 6:00 PM</strong></li>
          <li><i class="far fa-calendar-times me-2"></i>Sunday: <strong>Closed</strong></li>
        </ul>
      </div>
    </div>

  </div>
</div>

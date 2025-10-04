<?php
// Handle booking submission and redirect to payment success
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $room_type = $_POST['room_type'];
  $checkin = $_POST['checkin'];
  $checkout = $_POST['checkout'];
  $message = $_POST['message'];

  // Store in database (Replace with your DB credentials)
  $conn = new mysqli("localhost", "root", "", "hotel_utsav");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, room_type, checkin, checkout, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $name, $email, $phone, $room_type, $checkin, $checkout, $message);
  $stmt->execute();
  $stmt->close();
  $conn->close();

  echo "<script>window.location.href='?success=1';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Utsav</title>
  <link rel="icon" href="image/logo.png" type="image/png">
  <!--icon css-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Include Fonts in <head> -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@300;400;500;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="container" >
    <nav class="d-flex justify-content-between align-items-center flex-wrap py-2">
<div class="menu-toggle" onclick="toggleMenu(this)">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </div>

    <div class="nav-links" id="navLinks" data-aos="fade-up">
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="gallery.php">Gallery</a>
        <a href="booking.php" active>Booking</a>
        <a href="amenities.php">Amenities</a>
        <a href="contact.php">Contact Us</a>
        <a href="customer_login.php">Customer Login</a>
        <a href="admin/admin_login.php">Admin Login</a>
      </div>
      <div class="nav-links flex-column d-md-none w-100 mt-2" id="navLinksMobile" data-aos="fade-up">
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="gallery.php">Gallery</a>
        <a href="booking.php" active>Booking</a>
        <a href="amenities.php">Amenities</a>
        <a href="contact.php">Contact Us</a>
        <a href="customer_login.php">Customer Login</a>
        <a href="admin/admin_login.php">Admin Login</a>
      </div>
    </nav>
  </header>

  <!-- Carousel Section -->
  <div class="carousel-wrapper">
  <div class="carousel">
    <!-- Carousel Items -->
    <div class="list">
      <div class="item">
        <img src="image/b.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">Booking >> </div>
          <div class="des"><a href="index.php" style="color:White"> << Home </a></div>
        </div>
      </div>
      <div class="item">
        <img src="image/d.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">Booking >> </div>
          <div class="des"><a href="index.php" style="color:White"> << Home </a></div>
        </div>
      </div>
      <div class="item">
        <img src="image/e.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">Booking >> </div>
          <div class="des"><a href="index.php" style="color:White"> << Home </a></div>
        </div>
      </div>
      <div class="item">
        <img src="image/c.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">Booking >> </div>
          <div class="des"><a href="index.php" style="color:White"> << Home </a></div>
        </div>
      </div>
      <div class="item">
        <img src="image/a.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">Booking >> </div>
          <div class="des"><a href="index.php" style="color:White"> << Home </a></div>
        </div>
      </div>
    </div>


    <!-- Thumbnails -->
    <div class="thumbnail">
      <div class="item">
        <img src="image/b.jpg">
        <div class="content">
          <div class="title">HOTEL</div>
          <div class="description">Utsav</div>
        </div>
      </div>
      <div class="item">
        <img src="image/d.jpg">
        <div class="content">
          <div class="title">HOTEL</div>
          <div class="description">Utsav</div>
        </div>
      </div>
      <div class="item">
        <img src="image/e.jpg">
        <div class="content">
          <div class="title">HOTEL</div>
          <div class="description">Utsav</div>
        </div>
      </div>
      <div class="item">
        <img src="image/c.jpg">
        <div class="content">
          <div class="title">HOTEL</div>
          <div class="description">Utsav</div>
        </div>
      </div>
      <div class="item">
        <img src="image/a.jpg">
        <div class="content">
          <div class="title">HOTEL</div>
          <div class="description">Utsav</div>
        </div>
      </div>
    </div>

    <!-- Navigation Arrows -->
    <div class="arrows">
      <button id="prev">&lt;</button>
      <button id="next">&gt;</button>
    </div>

    <!-- Running time bar -->
    <div class="time"></div>
  </div>
  <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>
  </div>
  
  <?php if (isset($_GET['success'])): ?>
<div class="modal fade" id="paymentSuccessModal" tabindex="-1" aria-labelledby="paymentSuccessLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="paymentSuccessLabel">🎉 Payment Successful</h5>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 60px;"></i>
        <p class="mt-3 fs-5">Thank you! Your booking has been received.<br>We will contact you shortly.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <a href="index.php" class="btn btn-outline-success rounded-pill px-4">Go to Homepage</a>
      </div>
    </div>
  </div>
</div>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    const modal = new bootstrap.Modal(document.getElementById('paymentSuccessModal'));
    modal.show();
  });
</script>
<?php endif; ?>

<section class="py-5" id="booking">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8" data-aos="fade-up">
        <div class="booking-form">
          <h2 class="form-title text-center">Book Your Stay</h2>
          <form action="" method="post">
            <div class="row g-3">
              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
              </div>
              <div class="col-md-6">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
              </div>
              <div class="col-md-6">
                <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
              </div>
              <div class="col-md-6">
                <select name="room_type" class="form-select" required>
                  <option value="">Select Room Type</option>
                  <option value="Executive King Bed Room">Executive King Bed Room</option>
                  <option value="Executive Twin Bed Room">Executive Twin Bed Room</option>
                  <option value="Seminar Hall / Party Area">Seminar Hall / Party Area</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="checkin" class="form-label">Check-in Date</label>
                <input type="date" name="checkin" id="checkin" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="checkout" class="form-label">Check-out Date</label>
                <input type="date" name="checkout" id="checkout" class="form-control" required>
              </div>
              <div class="col-12">
                <textarea name="message" class="form-control" rows="4" placeholder="Additional Notes / Requests"></textarea>
              </div>
              <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-warning px-4 py-2 rounded-pill">Book Now</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Footer -->

<footer class="footer-section text-white text-center text-md-start py-5" >
  <div class="container">
    <div class="row">

      <!-- Hotel Info -->
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <h4 class="fw-bold">🏨 Hotel Utsav</h4>
        <p>Experience comfort and hospitality in the heart of Latur. Ideal for business and leisure travelers.</p>
        
      </div>

      <!-- Quick Links -->
      <div class="col-md-3 mb-4" >
        <h5 class="fw-bold" data-aos="fade-up">Quick Links</h5>
        <ul class="list-unstyled" data-aos="fade-up">
        <li><a href="index.php" class="text-white text-decoration-none">Home</a></li>
        <li><a href="about.php" class="text-white text-decoration-none">About Us</a></li>
        <li><a href="gallery.php" class="text-white text-decoration-none">Gallery</a></li>
        <li><a href="booking.php" active class="text-white text-decoration-none">Booking</a></li>
        <li><a href="amenities.php" class="text-white text-decoration-none">Amenities</a></li>
        <li><a href="contact.php" class="text-white text-decoration-none">Contact Us</a></li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div class="col-md-5 mb-4">
  <h5 class="fw-bold" data-aos="fade-up">Contact & Info</h5>
  <ul class="list-unstyled text-light small" data-aos="fade-up">
    <li><strong>📍 Address:</strong> Near Railway Station, Latur, Maharashtra</li>
    <li><strong>📞 Phone:</strong> +91 95034 28484</li>
    <li><strong>📞 Phone:</strong> +91 95611 98585</li>
    <li><strong>📞 Phone:</strong><a href="mailto:hotelutsavsquare@gmail.com?subject=Booking Inquiry&body=Hello,%20I%20would%20like%20to%20book%20a%20room." style="color: white"> hotelutsavsquare@gmail.com</a></li>
  </ul>

  <div class="social-icons mt-3" data-aos="fade-up">
    <span class="text-light me-2">Follow us:</span>
    <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-4"></i></a>
    <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-4"></i></a>
    <a href="#" class="text-white me-3"><i class="bi bi-snapchat fs-4"></i></a>
    <a href="#" class="text-white me-3"><i class="bi bi-whatsapp fs-4"></i></a>
  </div>
</div>

    </div>
    <hr class="border-light">
    <p class="text-center mb-0 small" >© 2025 <strong>Hotel Utsav</strong>. All rights reserved.</p>
  </div>
</footer>
<!-- Floating Luxury Icons -->
<div class="floating-icons">
  <!-- WhatsApp (Logo only) -->
<a href="https://wa.me/919503428484" target="_blank" class="lux-icon whatsapp-icon" title="Chat on WhatsApp">
  <i class="bi bi-whatsapp"></i>
</a>

  <!-- Booking -->
  <div class="lux-icon blur-bg" title="Book Now" onclick="toggleBookingPopup()">
    <i class="bi bi-calendar-check"></i>
  </div>
  <!-- Back to Top -->
  <a href="#top" class="lux-icon blur-bg" title="Back to Top">
    <i class="bi bi-arrow-up"></i>
  </a>
  
</div>

<!-- Booking Popup -->
<div id="bookingPopup" class="booking-popup shadow-lg">
  <div class="popup-header">
    <strong class="popup-title">🎉 Book Your Festival Stay</strong>
    <span onclick="toggleBookingPopup()" class="close-btn">&times;</span>
  </div>
  <div class="popup-body">
    <p class="mb-3">Experience elegance at <strong>Hotel Utsav Square</strong> – where every stay becomes a celebration.</p>
    
    <ul class="popup-reasons mb-4">
      <li><i class="bi bi-star-fill"></i> City-center Premium Location</li>
      <li><i class="bi bi-cone-striped"></i> Lavish Interiors & Banquet Hall</li>
      <li><i class="bi bi-wifi"></i> Free High-Speed Wi-Fi</li>
      <li><i class="bi bi-cup-hot"></i> Complimentary Breakfast</li>
      <li><i class="bi bi-door-open"></i> 24×7 Room Service</li>
    </ul>
        <a href="customer/customer_login.php" class="btn btn-book btn-lg w-100 rounded-pill fw-semibold">Book Now</a>

  </div>
</div>




  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
 function toggleMenu(icon) {
  icon.classList.toggle("change");
  const mobileMenu = document.getElementById('navLinksMobile');
  mobileMenu.classList.toggle("active");
}
function toggleBookingPopup() {
    document.getElementById('bookingPopup').classList.toggle('active');
  }
</script>
  <script src="app.js"></script>
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>

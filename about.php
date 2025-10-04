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
        <a href="about.php" active>About Us</a>
        <a href="gallery.php">Gallery</a>
        <a href="amenities.php">Amenities</a>
        <a href="contact.php">Contact Us</a>
        <a href="customer/customer_login.php">Customer Login</a>
        <a href="admin/admin_login.php">Admin Login</a>
      </div>
      <div class="nav-links flex-column d-md-none w-100 mt-2" id="navLinksMobile" data-aos="fade-up">
        <a href="index.php">Home</a>
        <a href="about.php" active>About Us</a>
        <a href="gallery.php">Gallery</a>
        <a href="amenities.php">Amenities</a>
        <a href="contact.php">Contact Us</a>
        <a href="customer/customer_login.php">Customer Login</a>
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
          <div class="topic" style="color: rgb(140, 255, 0);">About Us >> </div>
          <div class="des"><a href="index.php" style="color:White"> << Home </a></div>
        </div>
      </div>
      <div class="item">
        <img src="image/d.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">About Us >> </div>
          <div class="des"><a href="index.php" style="color:White"> << Home </a></div>
        </div>
      </div>
      <div class="item">
        <img src="image/e.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">About Us >> </div>
          <div class="des"><a href="index.php" style="color:White"> << Home </a></div>
        </div>
      </div>
      <div class="item">
        <img src="image/c.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">About Us >> </div>
          <div class="des"><a href="index.php" style="color:White"> << Home </a></div>
        </div>
      </div>
      <div class="item">
        <img src="image/a.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">About Us >> </div>
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
  
  <section class="py-5 bg-light" id="about">
  <div class="container">
    <div class="row align-items-center">
     <!-- Text Content -->
      <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" >
        <h6 class="text-uppercase text-warning fw-semibold mb-3">About Us</h6>
        <hr class="border-2 border-warning w-25 mb-4">
        <p class="text-muted fs-6 ">
          When it comes to <strong>luxury accommodation</strong>, it’s always <strong>Hotel Utsav Square</strong>. Designed with a vision to keep our guests comfortable and happy at all times, we offer a seamless blend of hospitality and world-class amenities including <em>free Wi-Fi</em>, <em>air-conditioned rooms</em>, <em>complimentary breakfast</em>, and 24×7 <em>room service</em>.
        </p>
        <p class="text-muted fs-6">
          Beyond interiors and conveniences, our prime <strong>city-center location</strong> ensures accessibility to all. Whether you’re visiting for a family trip, a business retreat, or festive celebration, our ambient space and courteous staff guarantee an experience you’ll remember.
        </p>
        <p class="text-muted fs-6">
          Experience comfort with beautifully styled rooms and elite banqueting facilities—making us the preferred choice across the <strong>Marathwada region</strong>.
        </p>
        <p class="fs-6 text-muted">
        At Hotel Utsav Square, every detail is thoughtfully crafted to provide a stay that blends elegance with warmth. From the moment you step into our grand lobby to the time you unwind in your plush, well-appointed room, you’ll feel the essence of refined hospitality. Whether it's savoring gourmet meals at our in-house dining area or hosting unforgettable events in our sophisticated banquet halls, we aim to turn every moment into a lasting memory—rooted in comfort, care, and class.
        </p>
      </div>

      <!-- Desktop Circular Cluster -->
<div class="col-lg-6 d-none d-md-flex justify-content-center position-relative" data-aos="fade-up">
  <div class="circle-frame">
    <img src="image/b.jpg" class="circle center-circle" alt="Main" style="box-shadow:0 14px 34px 24px rgba(0, 0, 0, 0.67);transition: transform 0.4s ease, box-shadow 0.3s ease;width:500px;height:500px">
  </div>
</div>

<!-- Mobile Card View -->
<div class="col-12 d-block d-md-none mb-4" data-aos="fade-up">
  <div class="card shadow border-0">
    <img src="image/b.jpg" class="card-img-top" alt="Hotel Image">
    <div class="card-body">
      <h5 class="card-title">Experience Luxury</h5>
      <p class="card-text">Enjoy world-class comfort, service, and ambience at Hotel Utsav Square.</p>
    </div>
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
        <li><a href="about.php" active class="text-white text-decoration-none">About Us</a></li>
        <li><a href="gallery.php" class="text-white text-decoration-none">Gallery</a></li>
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

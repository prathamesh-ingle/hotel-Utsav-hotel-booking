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
        <a href="index.php" active>Home</a>
        <a href="about.php">About Us</a>
        <a href="gallery.php">Gallery</a>
        <a href="amenities.php">Amenities</a>
        <a href="contact.php">Contact Us</a>
        <a href="customer/customer_login.php">Customer Login</a>
        <a href="admin/admin_login.php">Admin Login</a>
      </div>
      <div class="nav-links flex-column d-md-none w-100 mt-2" id="navLinksMobile" data-aos="fade-up">
        <a href="index.php" active>Home</a>
        <a href="about.php">About Us</a>
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
          <div class="topic" style="color: rgb(140, 255, 0);">हॉटेल उत्सव</div>
          <div class="des">Hotel Utsav Square in Latur offers family rooms with air-conditioning, TV, and electric kettle. Each room includes free WiFi, ensuring a pleasant stay.</div>
          <div class="buttons">
            <button><a href="about.php" style="color: black">SEE MORE</a></button>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="image/d.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">हॉटेल उत्सव</div>
          <div class="des">Hotel Utsav Square in Latur offers family rooms with air-conditioning, TV, and electric kettle. Each room includes free WiFi, ensuring a pleasant stay.</div>
          <div class="buttons">
            <button><a href="about.php" style="color: black">SEE MORE</a></button>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="image/e.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">हॉटेल उत्सव</div>
          <div class="des">Hotel Utsav Square in Latur offers family rooms with air-conditioning, TV, and electric kettle. Each room includes free WiFi, ensuring a pleasant stay.</div>
          <div class="buttons">
            <button><a href="about.php" style="color: black">SEE MORE</a></button>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="image/c.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">हॉटेल उत्सव</div>
          <div class="des">Hotel Utsav Square in Latur offers family rooms with air-conditioning, TV, and electric kettle. Each room includes free WiFi, ensuring a pleasant stay.</div>
          <div class="buttons">
            <button><a href="about.php" style="color: black">SEE MORE</a></button>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="image/a.jpg">
        <div class="content">
          <div class="author">HOTEL</div>
          <div class="title">Utsav</div>
          <div class="topic" style="color: rgb(140, 255, 0);">हॉटेल उत्सव</div>
          <div class="des">Hotel Utsav Square in Latur offers family rooms with air-conditioning, TV, and electric kettle. Each room includes free WiFi, ensuring a pleasant stay.</div>
          <div class="buttons">
            <button><a href="about.php" style="color: black">SEE MORE</a></button>
          </div>
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
      <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
        <h6 class="text-uppercase text-warning fw-semibold mb-3">About Our Hotel</h6>
        <h2 class="display-5 fw-bold mb-3 text-dark">Welcome to the <span class="text-primary">Destination of Festival</span></h2>
        <hr class="border-2 border-warning w-25 mb-4">
        
        <p class="fs-6 text-muted mb-4">
          <strong class="text-dark">Hotel Utsav Square</strong> redefines luxury and comfort in the heart of the city. Whether you're here for a business trip or a relaxing holiday, our thoughtfully designed rooms and elegant interiors offer a refined escape from the ordinary.
        </p>

        <p class="fs-6 text-muted mb-4">
          Enjoy a range of premium facilities including complimentary high-speed Wi-Fi, fully air-conditioned rooms, delicious breakfast, 24×7 room service, and courteous hospitality that feels like home.
        </p>

        <p class="fs-6 text-muted">
          Our central location makes us a convenient base for travelers, while our warm ambience and attentive staff ensure a truly memorable experience. Whether for business or leisure, your stay with us promises comfort, class, and care.
        </p>


      </div>

      <!-- Desktop Circular Cluster -->
<div class="col-lg-6 d-none d-md-flex justify-content-center position-relative" data-aos="fade-up">
  <div class="circle-frame">
    <img src="image/b.jpg" class="circle center-circle" alt="Main">
    <img src="image/e.jpg" class="circle bottom-left" alt="Bottom Left">
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


  <h2 style="text-align:center;font-size: 30px;color: rgb(47, 50, 49);font-family: 'Pappins'; padding-bottom: 50px;" data-aos="fade-up">Most Popular Facilities</h2>
  <div class="card-container" data-aos="fade-up">
    
    <!-- Restaurant -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front a">
          <h3 style="text-shadow: 18px 8px 18px rgba(0, 0, 0, 0.705);">Restaurants</h3>
        </div>
        <div class="flip-card-back">
          The modern, family-friendly restaurant serves Indian cuisine with vegetarian options. Guests can enjoy continental, buffet, and Asian breakfasts, including champagne, local specialities, warm dishes, juice, pancakes, and cheese.
        </div>
      </div>
    </div>

    <!-- Room service -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front b">
          <h3 style="text-shadow: 18px 8px 18px rgba(0, 0, 0, 0.705);">Room service</h3>
        </div>
        <div class="flip-card-back">
          At Hotel Utsav, our 24/7 room service ensures you experience ultimate relaxation without leaving the comfort of your room. Whether it's an early morning coffee, a hearty lunch, or a late-night snack, our prompt and courteous staff is just a call away.
        </div>
      </div>
    </div>

    <!-- Function Hall -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front c">
          <h3 style="text-shadow: 18px 8px 18px rgba(0, 0, 0, 0.705);">Function Hall</h3>
        </div>
        <div class="flip-card-back">
          our fully equipped Function Hall is designed to make your special moments unforgettable. Whether you're planning a wedding, birthday party, engagement, business seminar, or family gathering, our elegant and spacious venue adapts to every occasion.
        </div>
      </div>
    </div>

    <!-- Parking -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front d">
          <h3 style="text-shadow: 18px 8px 18px rgba(0, 0, 0, 0.705);">Parking</h3>
        </div>
        <div class="flip-card-back">
          At Hotel Utsav, we ensure your arrival and stay begin with ease. Our premises include a dedicated parking area to accommodate both two-wheelers and four-wheelers
        </div>
      </div>
    </div>

    <!-- Party Area -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front e">
          <h3 style="text-shadow: 18px 8px 18px rgba(0, 0, 0, 0.705);">Party Area</h3>
        </div>
        <div class="flip-card-back">
          we offer a beautifully designed party area perfect for birthdays, anniversaries, baby showers, family get-togethers, festive events, and more. Whether you prefer an elegant indoor vibe or an open-air garden setting, we’ve got the ideal space for you.
        </div>
      </div>
    </div>

  </div>
  
  <section class="container my-5">
  <h2 style="text-align:center;font-size: 30px;color: rgb(47, 50, 49);font-family: 'Pappins'; padding-bottom: 50px;" data-aos="fade-up">What Our Customers Say's</h2>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" >
    
    <div class="col" data-aos="fade-up">
      <div class="card h-100 shadow-sm border-0 p-3">
        <div class="d-flex align-items-center mb-2">
          <img src="image/k.jpg" class="rounded-circle me-3" alt="Customer Photo" style="width: 50px;height:50px">
          <div>
            <h5 class="mb-0">Prathamesh Ingle</h5>
            <small class="text-muted">Stayed in June 2025</small>
          </div>
        </div>
        <p>"Wonderful experience! The rooms were clean and the food was excellent."</p>
        <div class="stars">
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9734;</span>
        </div>
      </div>
    </div>
    <div class="col" data-aos="fade-up">
      <div class="card h-100 shadow-sm border-0 p-3">
        <div class="d-flex align-items-center mb-2">
          <img src="image/k.jpg" class="rounded-circle me-3" alt="Customer Photo" style="width: 50px;height:50px">
          <div>
            <h5 class="mb-0">Vedant Mali</h5>
            <small class="text-muted">Stayed in May 2025</small>
          </div>
        </div>
        <p>"Perfect place for family trips. Loved the hospitality and ambiance."</p>
        <div class="stars">
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9734;</span>
          <span class="star">&#9734;</span>
        </div>
      </div>
    </div>

    <div class="col" data-aos="fade-up">
      <div class="card h-100 shadow-sm border-0 p-3">
        <div class="d-flex align-items-center mb-2">
          <img src="image/k.jpg" class="rounded-circle me-3" alt="Customer Photo" style="width: 50px;height:50px">
          <div>
            <h5 class="mb-0">Ajay Suryawanshi</h5>
            <small class="text-muted">Stayed in May 2025</small>
          </div>
        </div>
        <p>"Clean rooms, courteous staff, and delicious food. Would visit again!"</p>
        <div class="stars">
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
        </div>
      </div>
    </div>

    <div class="col" data-aos="fade-up">
      <div class="card h-100 shadow-sm border-0 p-3">
        <div class="d-flex align-items-center mb-2">
          <img src="image/k.jpg" class="rounded-circle me-3" alt="Customer Photo" style="width: 50px;height:50px">
          <div>
            <h5 class="mb-0">Shivkumar Swami</h5>
            <small class="text-muted">Stayed in May 2025</small>
          </div>
        </div>
        <p>"Loved the function hall and decor! Perfect place for celebrations."</p>
        <div class="stars">
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
        </div>
      </div>
    </div>

    <div class="col" data-aos="fade-up">
      <div class="card h-100 shadow-sm border-0 p-3">
        <div class="d-flex align-items-center mb-2">
          <img src="image/k.jpg" class="rounded-circle me-3" alt="Customer Photo" style="width: 50px;height:50px">
          <div>
            <h5 class="mb-0">Sujwal Paddar</h5>
            <small class="text-muted">Stayed in May 2025</small>
          </div>
        </div>
        <p>"Excellent service and spacious rooms. The location was very convenient."</p>
        <div class="stars">
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9734;</span>
        </div>
      </div>
    </div>

    <div class="col" data-aos="fade-up">
      <div class="card h-100 shadow-sm border-0 p-3">
        <div class="d-flex align-items-center mb-2">
          <img src="image/k.jpg" class="rounded-circle me-3" alt="Customer Photo" style="width: 50px;height:50px">
          <div>
            <h5 class="mb-0">Aditya Kamble</h5>
            <small class="text-muted">Stayed in May 2025</small>
          </div>
        </div>
        <p>"Excellent service and spacious rooms. The location was very convenient."</p>
        <div class="stars">
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
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
        <li><a href="index.php" active class="text-white text-decoration-none">Home</a></li>
        <li><a href="about.php" class="text-white text-decoration-none">About Us</a></li>
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

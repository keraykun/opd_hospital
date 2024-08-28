<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> BPH Kibawe - Out Patient Department (OPD)</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('images/logo/logo.png') }}" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: KIBAWE OPD HOSPITAL
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/KIBAWE OPD HOSPITAL-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        
      </div>
      
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="#">BPH KIBAWE - OPD</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#doctors">Doctors</a></li>
          @if (Auth::check())
             <li>
                @if (Auth::user()->is_role=='patient')
                <a style="font-weight:bold; color:#1977cc;" class="nav-link scrollto" href="{{ route('patient.appointment.index') }}">{{ Auth::user()->email }}</a></a>
                @elseif (Auth::user()->is_role=='doctor')
                <a style="font-weight:bold; color:#1977cc;" class="nav-link scrollto" href="{{ route('doctor.appointment.index') }}">{{ Auth::user()->email }}</a></a>
                @else
                <a style="font-weight:bold; color:#1977cc;" class="nav-link scrollto" href="{{ route('admin.appointment.index') }}">{{ Auth::user()->email }}</a></a>
                @endif
            </li>
          @endif
          {{-- <li><a class="nav-link scrollto" href="#contact">Contact</a></li> --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" style="display: flex; align-items:center;">
        <section>
            <img style="width: 200px; height:250px;" src="{{ asset('images/logo/logo.png') }}" alt="">
        </section>
        <section style="text-shadow: 2px 7px 5px rgba(36, 32, 32, 0.3),
        0px -4px 10px rgba(255,255,255,0);">
            <h2>Welcome to</h2>
            <h1> OUTPATIENT DEPARTMENT -<br>BUKIDNON PROVINCIAL HOSPITAL KIBAWE</h1>
        </section>
    </div>
  </section><!-- End Hero -->

  <main id="main">


 @yield('content')


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>BPH KIBAWE OPD</h3>
            <p>
              KIBAWE <br>
              BUKIDNON<br>
              PHILIPPINES <br><br>
              <strong>Phone:</strong> +63 9384 061 868<br>
              <strong>Email:</strong> bphkopd@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>
          

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>BUKIDNON PROVINCIAL HOSPITAL KIBAWE - OUTPATIENT DEPARTMENT</span></strong>All Rights Reserved.
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script> --}}

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>

    // JavaScript code for scrolling to the target div
    document.addEventListener('DOMContentLoaded', function() {
        // Check if there's a hash in the URL (e.g., #appointments)
        var hash = window.location.hash.substring(1);
        var targetElement = document.getElementById(hash);
        // If the hash is found, scroll to the target element
        if (targetElement) {

            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>
<script>
   document.getElementById('datetime').addEventListener('input', function() {
    var selectedDate = new Date(this.value);
    var now = new Date();
    var year2024 = new Date('2025-01-01T00:00');

    // Compare the selected date with the current date and limit to the year 2023
    if (selectedDate < now || selectedDate > year2024) {
        document.getElementById('invalidTime').textContent = 'Please select a valid date and time within the range of today and the year 2023.'
        this.value = '';
    }
    });

    // Disable past and future dates and times outside the range of the year 2023
    document.getElementById('datetime').addEventListener('focus', function() {
    var now = new Date();
    var year2024 = new Date('2025-01-01T00:00');
    var minDate = now.toISOString().slice(0, 16); // Format: "YYYY-MM-DDTHH:mm"
    var maxDate = year2024.toISOString().slice(0, 16); // Format: "YYYY-MM-DDTHH:mm"

    this.setAttribute('min', minDate);
    this.setAttribute('max', maxDate);
    });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ศูนย์พัฒนาเด็กเล็ก บ้านหนองคูโคก</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="{{ url('assets/image/logoschool/logo1.png') }}">
    {{-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Presento - v3.7.0
  * Template URL: https://bootstrapmade.com/presento-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="index.html">ศูนย์พัฒนาเด็กเล็ก<span></span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt=""></a>-->
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">หน้าแรก</a></li>
                    <li class="dropdown">
                        <a href="#">
                            <span>ข้อมูลพื้นฐานโรงเรียน</span>
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span>
                                    <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#">บุคลากร</a></li>
                    <li><a class="nav-link scrollto " href="#">ภาพกิจกรรม</a></li>
                    <li><a class="nav-link scrollto" href="#">ติดต่อ</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <a href="#about" class="get-started-btn scrollto">เข้าสู่ระบบ</a>
        </div>
    </header><!-- End Header -->
    <style>
        .img-slide-show {
            min-width: 1366px !important;
            max-width: 1366px !important;
            min-height: 510px !important;
            max-height: 510px !important;
        }

        .indent {
            text-indent: 2.5em;
        }

    </style>
    <section class=" d-flex align-items-center">
        {{-- <div class="container"> --}}
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleCaptions" class="carousel slide img-slide-show" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/image/slideshow/slide1.jpg" class="d-block w-100 ">
                        </div>
                        <div class="carousel-item">
                            <img src="assets/image/slideshow/slide2.jpeg" class="d-block w-100 ">
                        </div>
                        <div class="carousel-item">
                            <img src="assets/image/slideshow/slide3.jpeg" class="d-block w-100 ">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            {{-- <div class="col-md-5 ">
                    <section id="counts" class="counts">
                        <div class="container" data-aos="fade-up">
                            <div class="row bg-primary">
                                <div class="col-lg-6 col-md-6 ">
                                    <div class="count-box ">
                                        <i class="bi bi-emoji-smile"></i>
                                        <span data-purecounter-start="0" data-purecounter-end="232"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p>นักเรียนทั้งหมด</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mt-5 mt-md-0">
                                    <div class="count-box">
                                        <i class="bi bi-journal-richtext"></i>
                                        <span data-purecounter-start="0" data-purecounter-end="521"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p>บุคลากรทั้งหมด</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                    <section id="counts" class="counts">
                        <div class="container" data-aos="fade-up">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mt-5 mt-lg-0">
                                    <div class="count-box">
                                        <i class="bi bi-headset"></i>
                                        <span data-purecounter-start="0" data-purecounter-end="1463"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p>Hours Of Support</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mt-5 mt-lg-0">
                                    <div class="count-box">
                                        <i class="bi bi-people"></i>
                                        <span data-purecounter-start="0" data-purecounter-end="15"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p>นักเรียนสมัครเข้าใหม่</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div> --}}
        </div>
        {{-- </div> --}}
    </section>
    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">
                <div class="row no-gutters">
                    <div class="content col-xl-5 d-flex align-items-stretch">
                        <img src="assets/image/people/director.png" class="rounded mx-auto d-block">
                    </div>
                    <div class="col-xl-7 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="card">
                                <div class="card-body text-black">
                                    <h2 class="text-center">
                                        <b>สาส์นจากผู้อำนวยการ <br></b>
                                    </h2>
                                    <h5 class="indent">
                                        ขอขอบคุณผู้ปกครองนักเรียน
                                        นักศึกษาที่ให้ความไว้วางใจวิทยาลัยที่ให้ความร่วมมืออย่างดีในกิจกรรมต่างๆ
                                        ของวิทยาลัยฯ
                                        ขอขอบใจนักเรียนนักศึกษาทุกคนที่ปฏิบัติตนอยู่ในระเบียบของวิทยาลัย
                                        อยู่ในโอวาทของทุกคน
                                        เป็นนักเรียนนักศึกษาที่ วิทยาลัยภาคภูมิใจ
                                        <br>
                                        <br>
                                    </h5>
                                    <h3 class="text-center text-primary">
                                        นายอาคม จันทร์นาม <br>
                                        ผู้อำนวยการศูนย์พัฒนาเด็กเล็ก บ้านหนองคูโคก <br>
                                    </h3>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->
        <!-- ======= Tabs Section ======= -->
        <section id="tabs" class="tabs">
            <div class="container" data-aos="fade-up">
                <ul class="nav nav-tabs row d-flex">
                    <li class="nav-item col-6">
                        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                            <i class="ri-gps-line"></i>
                            <h4 class="d-none d-lg-block">ความเป็นมาศูนย์พัฒนาเด็กเล็ก</h4>
                        </a>
                    </li>
                    <li class="nav-item col-6">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                            <i class="ri-body-scan-line"></i>
                            <h4 class="d-none d-lg-block">คำขวัญศูนย์พัฒนาเด็กเล็ก</h4>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab-1">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" data-aos="fade-up"
                                data-aos-delay="100">
                                <h3>ความเป็นมาศูนย์พัฒนาเด็กเล็ก</h3>
                                <p class="fst-italic">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                    magna aliqua.
                                </p>
                                <ul>
                                    <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat.</li>
                                    <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit
                                        in
                                        voluptate velit.</li>
                                    <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        trideta
                                        storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                                </ul>
                                <p>
                                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in
                                    reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                    cupidatat
                                    non proident, sunt in
                                    culpa qui officia deserunt mollit anim id est laborum
                                </p>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up"
                                data-aos-delay="200">
                                <img src="assets/img/tabs-1.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-2">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>คำขวัญศูนย์พัฒนาเด็กเล็ก</h3>
                                <p>
                                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in
                                    reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                    cupidatat
                                    non proident, sunt in
                                    culpa qui officia deserunt mollit anim id est laborum
                                </p>
                                <p class="fst-italic">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                    magna aliqua.
                                </p>
                                <ul>
                                    <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat.</li>
                                    <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit
                                        in
                                        voluptate velit.</li>
                                    <li><i class="ri-check-double-line"></i> Provident mollitia neque rerum
                                        asperiores
                                        dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</li>
                                    <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        trideta
                                        storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="assets/img/tabs-2.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Tabs Section -->
        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>ข่าวสารศูนย์พัฒนาเด็กเล็ก</h2>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">ทั้งหมด</li>
                            @php
                                $months_full_th = ['1' => 'มกราคม', '2' => 'กุมภาพันธ์', '3' => 'มีนาคม', '4' => 'เมษายน', '5' => 'พฤษภาคม', '6' => 'มิถุนายน', '7' => 'กรกฎาคม', '8' => 'สิงหาคม', '9' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'];
                                $months_th = ['1' => 'ม.ค.', '2' => 'ก.พ.', '3' => 'มี.ค.', '4' => 'เม.ย', '5' => 'พ.ค.', '6' => 'มิ.ย.', '7' => 'ก.ค.', '8' => 'ส.ค.', '9' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.'];
                            @endphp
                            @for ($i = 1; $i <= 12; $i++)
                                <li data-filter=".month-{{ $i }}">{{ $months_th[$i] }}</li>
                            @endfor
                        </ul>
                    </div>
                </div>
                <style>
                    .text-check-long {
                        text-indent: 2.5em;
                        display: -webkit-box;
                        -webkit-line-clamp: 4;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }

                </style>
                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @for ($post = 1; $post <= 12; $post++)
                        <div class="col-lg-4 col-md-6 portfolio-item month-{{ $post }}">
                            <article class="entry">
                                <div class="entry-img">
                                    <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                                </div>
                                <h2 class="entry-title">
                                    <a href="blog-single.html">ตรวจวัดอุณหภูมิ</a>
                                </h2>
                                <div class="entry-content">
                                    <p class="text-check-long">
                                        Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi
                                        praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                                        Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi
                                        praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                                    </p>
                                    <i class="bi bi-clock me-2"></i>
                                    {{ date('d ') . $months_full_th[$post] . date(' Y ') }}
                                    <div class="read-more  my-3">
                                        <a href="blog-single.html">Read More</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @if ($post >= 6)
                        @break
                    @endif
                    @endfor
                </div>
                <div class="row">
                    <div class="col-md-10">
                    </div>
                    <div class="col-md-2 ">
                        <a href="#" class="btn btn-primary mr-4">
                            <i class="fas fa-hand-point-right me-2"></i>อ่านข่าวทั้งหมด</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>ติดต่อ</h2>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <i class="bx bx-map"></i>
                                    <h3>Our Address</h3>
                                    <p>A108 Adam Street, New York, NY 535022</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bx bx-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>info@example.com<br>contact@example.com</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bx bx-phone-call"></i>
                                    <h3>Call Us</h3>
                                    <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Presento<span>.</span></h3>
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
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

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>Presento</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/presento-bootstrap-corporate-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
            <div class="social-links text-center text-md-end pt-3 pt-md-0">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/sweetalert2@11.js"></script>


</body>

</html>

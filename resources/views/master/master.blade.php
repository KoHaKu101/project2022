<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @yield("meta")
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
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @yield("addcss")
    <!-- =======================================================
  * Template Name: Presento - v3.7.0
  * Template URL: https://bootstrapmade.com/presento-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- ======= Header ======= -->
    @include("master.head")
    @yield("body")

    @include("master.footer")
    @include("master.modal_login")

    {{-- end modal login --}}
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('assets/js/ajaxsetup.js') }}"></script>
    <script src="{{ asset('assets/js/master.js') }}"></script>
    <script src="{{ asset('assets/js/register.js') }}"></script>
    <script src="{{ asset('assets/js/login.js') }}"></script>
    <script>
        function closemodallogin() {

        }
    </script>
    @include('sweetalert::alert')
    @yield("addjava")

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>ศูนย์พัฒนาเด็กเล็ก บ้านหนองคูโคก</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" href="{{ url('assets/image/logoschool/logo1.png') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/atlantis/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('assets/atlantis/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/atlantis/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/atlantis/css//atlantis.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/js/OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/dist/assets/owl.carousel.css') }}">
    @yield('css')

</head>

<body>
    <div class="wrapper">
        @include('masteredit.head')
        @include('masteredit.sidebar')
        <div class="main-panel">
            @yield('content')
            @include('masteredit.footer')

        </div>
        <!--   Core JS Files   -->
        <script src="{{ asset('assets/atlantis/js/core/jquery.3.2.1.min.js') }}"></script>
        <script src="{{ asset('assets/atlantis/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/atlantis/js/core/bootstrap.min.js') }}"></script>
        <!-- jQuery UI -->
        <script src="{{ asset('assets/atlantis/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/atlantis/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
        <!-- jQuery Scrollbar -->
        <script src="{{ asset('assets/atlantis/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        <!-- Sweet Alert -->
        <script src="{{ asset('assets/atlantis/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('assets/atlantis/js/atlantis.min.js') }}"></script>
        <script src="{{ asset('assets/js/OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/dist/owl.carousel.js') }}"></script>
        <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
        @include('sweetalert::alert')
        <script src="{{ asset('assets/js/ajaxsetup.js') }}"></script>
        @yield('java')


</body>

</html>

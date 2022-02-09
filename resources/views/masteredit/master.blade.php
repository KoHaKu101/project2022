<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
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
                urls: ['../assets/css/fonts.min.css']
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


</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="{{ route('edit.home') }}" class="logo">
                    <img src="{{ asset('assets/atlantis/img/logo.svg') }}" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="{{ asset('assets/image/editprofile/adminprofile.png') }}" alt="..."
                                        class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img
                                                    src="{{ asset('assets/image/editprofile/adminprofile.png') }}"
                                                    alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4>{{ Auth::user()->FIRST_NAME }} {{ Auth::user()->LAST_NAME }}
                                                </h4>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <style>
            li.nav-item {
                margin-top: 1rem !important;
            }

            .bg-purple {
                background-color: #a364d3 !important;

            }

            /* .owl-carousel .owl-item img {
                width: auto !important;
                height: 300px;
            } */

        </style>
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="{{ asset('assets/image/editprofile/adminprofile.png') }}" alt="..."
                                class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true"
                                style="cursor:default">
                                <span>
                                    {{ Auth::user()->FIRST_NAME }}
                                    <span class="user-level">แอดมิน</span>
                                </span>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <ul class="nav nav-primary ">
                        <li class="nav-item active">
                            <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>หน้าหลัก</p>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>ข้อมูลพื้นฐานโรงเรียน</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>บุคลากร</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>ภาพกิจกรรม</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>ติดต่อ</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="page-inner py-3">
                    <div class="card">
                        <div class="card-header bg-purple text-white">
                            <h4>ภาพไสด์</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <img src="{{ asset('assets/image/slideshow/slide1.jpg') }}"
                                        class="w-100">
                                    <h4 class="text-center">ภาพไสด์ที่ 1</h4>
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('assets/image/slideshow/slide1.jpg') }}"
                                        class="w-100">
                                    <h4 class="text-center">ภาพไสด์ที่ 2</h4>
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('assets/image/slideshow/slide1.jpg') }}"
                                        class="w-100">
                                    <h4 class="text-center">ภาพไสด์ที่ 3</h4>
                                </div> --}}
                                <div class="owl-carousel owl-theme text-center">
                                    <div class="item">
                                        <img src="{{ asset('assets/image/slideshow/slide1.jpg') }}"
                                            class="w-100">
                                        <h4>ภาพไสด์ที่ 1</h4>

                                    </div>
                                    <div class="item">
                                        <img src="{{ asset('assets/image/slideshow/slide1.jpg') }}"
                                            class="w-100">
                                        <h4>ภาพไสด์ที่ 2</h4>

                                    </div>
                                    <div class="item">
                                        <img src="{{ asset('assets/image/slideshow/slide1.jpg') }}"
                                            class="w-100">
                                        <h4>ภาพไสด์ที่ 3</h4>

                                    </div>
                                    <div class="item">
                                        <img src="{{ asset('assets/image/slideshow/slide1.jpg') }}"
                                            class="w-100">
                                        <h4>ภาพไสด์ที่ 4</h4>

                                    </div>
                                    <div class="item">
                                        <img src="{{ asset('assets/image/slideshow/slide1.jpg') }}"
                                            class="w-100">
                                        <h4>ภาพไสด์ที่ 5</h4>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.themekita.com">
                                        ThemeKita
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Help
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Licenses
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="copyright ml-auto">
                            2018, made with <i class="fa fa-heart heart text-danger"></i> by <a
                                href="https://www.themekita.com">ThemeKita</a>
                        </div>
                    </div>
                </footer>
            </div>

            <!-- Custom template | don't include it in your project! -->

            <!-- End Custom template -->
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

        <!-- Atlantis JS -->
        <script src="{{ asset('assets/atlantis/js/atlantis.min.js') }}"></script>
        <script src="{{ asset('assets/js/OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/dist/owl.carousel.js') }}"></script>
        <script>
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,

                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            })
        </script>
</body>

</html>
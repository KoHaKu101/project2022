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
                                        <a class="dropdown-item" href="{{ route('homepage') }}">หน้าแสดงผล</a>
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

            .btn-self {
                font-size: 16px;
                padding: 4px 13px;
            }

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
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <h1>ภาพสไลด์ ทั้งหมด {{ $LIMIT_NUMBER }} </h1>
                                </div>
                                <div class="col-sm-6 col-md-6 text-right">
                                    <button class="btn btn-warning " onclick="addslide()">เพิ่มจำนวนสไลด์</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="owl-carousel owl-theme text-center">
                                    @php
                                        $IMG__PATH = 'slide_noimg.png';

                                    @endphp
                                    @for ($i = 1; $i <= $LIMIT_NUMBER; $i++)
                                        @php
                                            if ($IMG_SLIDE) {
                                                $IMG = $IMG_SLIDE->where('IMG_NUMBER', '=', $i)->first();
                                                $IMG__PATH = isset($IMG->IMG_FILE) ? $IMG->IMG_FILE . $IMG->IMG_EXT : 'slide_noimg.png';
                                            }
                                        @endphp
                                        <div class="item">
                                            <img src="{{ asset('assets/image/slideshow/' . $IMG__PATH) }}"
                                                class="w-100">
                                            <h4>ภาพไสด์ที่ {{ $i }}</h4>
                                            <div class="row">
                                                @if (isset($IMG->IMG_FILE))
                                                    <div class="col-md-6">
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm text-center btn-self btn-block"
                                                            onclick="modalslide(this)"
                                                            data-number="{{ $i }}">
                                                            แก้ไข
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm text-center btn-self btn-block"
                                                            onclick="delete_slide_img(this)"
                                                            data-number="{{ $i }}">
                                                            ลบรูป
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="col-md-12">
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm text-center btn-self btn-block"
                                                            onclick="modalslide(this)"
                                                            data-number="{{ $i }}">
                                                            แก้ไข
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .indent {
                            text-indent: 2.5em;
                        }

                    </style>
                    <div class="card">
                        <div class="card-header bg-purple">
                            <div class="row text-white">
                                <div class="col-md-12">
                                    <h1>สาส์นจากผู้อำนวยการ</h1>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 text-center">
                                    <form action="{{ route('director.upload') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <img src="{{ asset('assets/image/people/' . $IMG_DIRECTOR) }}"
                                            id="SHOW_DIRECTOR" style="height:299px;width:243px">
                                        <div class="form-inline">
                                            <input type="file" class="form-control form-control-sm " id="IMG_DIRECTOR"
                                                name="IMG_DIRECTOR">
                                            <button type="submit" class="btn btn-success btn-sm "
                                                style="font-size:16px">
                                                บันทึก</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-md-7">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="indent">
                                                ขอขอบคุณผู้ปกครองนักเรียน
                                                นักศึกษาที่ให้ความไว้วางใจวิทยาลัยที่ให้ความร่วมมืออย่างดีในกิจกรรมต่างๆ
                                                ของวิทยาลัยฯ
                                                ขอขอบใจนักเรียนนักศึกษาทุกคนที่ปฏิบัติตนอยู่ในระเบียบของวิทยาลัย
                                                อยู่ในโอวาทของทุกคน เป็นนักเรียนนักศึกษาที่ วิทยาลัยภาคภูมิใจ
                                            </h3>
                                            <br>
                                            <br>
                                            <h1 class="text-center text-primary">
                                                นายอาคม จันทร์นาม<br>
                                                ผู้อำนวยการศูนย์พัฒนาเด็กเล็ก บ้านหนองคูโคก
                                            </h1>
                                        </div>
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
        </div>
        <div class="modal fade" id="modalslide" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-header bg-primary">
                                <h3 class="modal-title" id="MODAL_NAME_SLIDE"></h3>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" id="FRM_UPLOAD" action="{{ route('slide.upload') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="NUMBER_SLIDE" name="NUMBER_SLIDE">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <input type="file" class="form-control " id="FILE_IMG" name="FILE_IMG"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3 ">
                                                <button type="submit" class="btn btn-success w-100">อัพโหลด</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <img id="category-img-tag" class="w-100"
                                                    style="height: 432px">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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
        <script>
            function delete_slide_img(thisdata) {
                var number_img = $(thisdata).data('number');
                Swal.fire({
                    icon: 'warning',
                    title: 'ยืนยันการลบไฟล์',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#5cb85c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<i class="fa fa-trash"></i> ยืนยัน',
                    cancelButtonText: '<i class="fa fa-times"></i> ยกเลิก',
                }).then(function(result) {
                    if (result.isConfirmed) {
                        var url = "{{ route('slide.remove') }}";
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                'IMG_NUMBER': number_img
                            },
                            success: function(response) {
                                if (response.massage) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ลบไฟล์สำเร็จ',
                                        showCloseButton: true,
                                        showCancelButton: false,
                                        confirmButtonColor: '#5cb85c',
                                        confirmButtonText: '<i class="fa fa-check"></i> ยืนยัน',
                                    }).then(function(result) {
                                        location.reload();
                                    })
                                }
                            }
                        });
                    }
                })
            }
            $('.owl-carousel').owlCarousel({
                loop: false,
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

            function addslide() {

                Swal.fire({
                    text: 'ใส่จะนวนสไลด์ที่ต้องการ',
                    input: 'number'
                }).then(function(result) {
                    if (result.value) {
                        var url = "{{ route('slide.number') }}?number=" + result.value;
                        $.ajax({
                            type: "POST",
                            url: url,
                            success: function(response) {
                                if (response.message == 'true') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'บันทึกข้อมูลสำเร็จ',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'เกิดข้อผิดพลาด',
                                        text: 'กรุณาลองใหม่หรือติดต่อผู้ดูแลระบบ',
                                    })
                                }
                            }
                        });

                    }
                })
            }

            function modalslide(thisdata) {
                var number_slide = $(thisdata).data("number");
                var modal_header = "ภาพสไสลด์ที่" + number_slide;
                $('#MODAL_NAME_SLIDE').html(modal_header);
                $("#NUMBER_SLIDE").val(number_slide);
                $('#modalslide').modal("show");
            }

            function readURL(input, id_img) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + id_img).attr('src', e.target.result);

                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#FILE_IMG").change(function() {
                var id_img = 'category-img-tag';
                readURL(this, id_img);
                $('#' + id_img).css('height', '432px', 'width', '768px');

            });
            $('#IMG_DIRECTOR').change(function() {
                var id_img = 'SHOW_DIRECTOR';
                readURL(this, id_img);
                $('#' + id_img).css('height', '299px', 'width', '243px');
            });
        </script>
</body>

</html>

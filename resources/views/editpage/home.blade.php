@extends("masteredit.master")
@section('content')
    <div class="content">
        <div class="page-inner py-3">
            <div class="card">
                <div class="card-header bg-purple text-white">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-inline">
                                <h1>ภาพสไลด์ ทั้งหมด {{ $LIMIT_NUMBER }} </h1>
                                <button class="btn btn-warning ml-auto" onclick="addnumber_slide()">เพิ่มจำนวนสไลด์</button>
                            </div>
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
                                    <img src="{{ asset('assets/image/slideshow/' . $IMG__PATH) }}" class="w-100">
                                    <h4>ภาพไสด์ที่ {{ $i }}</h4>
                                    <div class="row">
                                        @if (isset($IMG->IMG_FILE))
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-warning btn-sm text-center btn-self btn-block my-2"
                                                    onclick="modalslide(this)" data-number="{{ $i }}">
                                                    แก้ไข
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm text-center btn-self btn-block my-2"
                                                    onclick="delete_slide_img(this)" data-number="{{ $i }}">
                                                    ลบรูป
                                                </button>
                                            </div>
                                        @else
                                            <div class="col-md-12">
                                                <button type="button"
                                                    class="btn btn-warning btn-sm text-center btn-self btn-block my-2"
                                                    onclick="modalslide(this)" data-number="{{ $i }}">
                                                    เพิ่มรูป
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

                .text-byme {
                    font-size: 16px;
                }

            </style>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-purple">
                            <h1 class="text-white">รูปผู้อำนวยการ</h1>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <img src="{{ asset('assets/image/people/' . $IMG_DIRECTOR) }}" id="SHOW_DIRECTOR"
                                        style="height:299px;width:243px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('director.upload') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-inline">
                                            <input type="file" class="form-control form-control-sm " id="IMG_DIRECTOR"
                                                name="IMG_DIRECTOR" required>
                                            <button type="submit" class="btn btn-success btn-sm my-2 ml-auto text-byme">
                                                บันทึก</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card" style="height:475px">
                        <div class="card-header bg-purple">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-inline">
                                        <h1 class="text-white">สาส์นจากผู้อำนวยการ</h1>
                                        <button type="button" class="btn btn-warning btn-sm text-byme ml-auto"
                                            onclick="director()">
                                            แก้ไขข้อความ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class=" row">
                                <div class="col-md-12">
                                    <h3 class="indent" id="DIRECTOR_TEXT">
                                        {{ isset($DIRECTOR_TEXT->POST_TEXT) ? $DIRECTOR_TEXT->POST_TEXT : '' }}
                                    </h3>
                                    <br>
                                    <br>
                                    <h1 class="text-center text-primary" id="DIRECTOR_NAME">
                                        {{ isset($DIRECTOR_TEXT->POST_NAME) ? $DIRECTOR_TEXT->POST_NAME : '' }}
                                    </h1>
                                    <h1 class="text-center text-primary" id="DIRECTOR_SCHOOL">
                                        {{ isset($DIRECTOR_TEXT->POST_SCHOOL) ? $DIRECTOR_TEXT->POST_SCHOOL : '' }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-purple">
                            <div class="row">
                                <div class="col-md-12 text-white">
                                    <div class="form-inline">
                                        <h1>เกี่ยวกับโรงเรียน</h1>
                                        <button type="button" class="btn btn-warning text-byme ml-auto"
                                            onclick="modal_about(this)" data-name="เพิ่มข้อมูล">
                                            <i class="fas fa-plus"></i>
                                            เพิ่มข้อมูล
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($ABOUT_SCHOOL as $index => $row_about)
                                    <div class="col-sm-6 col-md-6 col-lg-4 text-center">
                                        <button type="button" class="btn btn-primary btn-lg my-2"
                                            style="font-size: 1.1625rem;" data-name="{{ $row_about->ABOUT_NAME }}"
                                            data-unid="{{ $row_about->UNID }}" onclick="modal_about_data(this)">
                                            {{ $row_about->ABOUT_NAME }}
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-purple">
                            <div class="row ">
                                <div class="col-md-12 text-white">
                                    <div class="form-inline">
                                        <h1>ข่าวสาร</h1>
                                        <div class="form-group  ">
                                            <h1 class="mr-2"> ประจำเดือน :</h1>
                                            <select class="form-control text-byme " style="padding: 0.1rem 1rem">
                                                @php
                                                    $months_full_th = ['0' => 'ทั้งหมด', '1' => 'มกราคม', '2' => 'กุมภาพันธ์', '3' => 'มีนาคม', '4' => 'เมษายน', '5' => 'พฤษภาคม', '6' => 'มิถุนายน', '7' => 'กรกฎาคม', '8' => 'สิงหาคม', '9' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'];
                                                @endphp
                                                @for ($n_month = 0; $n_month <= 12; $n_month++)
                                                    <option value="{{ $n_month }}"
                                                        {{ $n_month == date('n') ? 'selected' : '' }}>
                                                        {{ $months_full_th[$n_month] }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group  mr-auto">
                                            <h1 class="mr-2"> ประเภทข้อมูล :</h1>
                                            <select class="form-control text-byme " style="padding: 0.1rem 1rem">
                                                <option value="TYPE_DEFAULT" selected>ข้อมูลทั่วไป</option>
                                                <option value="TYPE_PDF"> ข้อมูล PDF</option>

                                            </select>
                                        </div>
                                        <div class="form-group  ml-auto">
                                            <button type="button" class="btn btn-warning text-byme"
                                                onclick="modal_post(this)" data-name="เพิ่มข่าวสาร">
                                                <i class="fas fa-plus"></i>
                                                เพิ่มข่าวสาร
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($ABOUT_SCHOOL as $index => $row_about)
                                    <div class="col-sm-6 col-md-6 col-lg-4 text-center">
                                        <button type="button" class="btn btn-primary btn-lg my-2"
                                            style="font-size: 1.1625rem;" data-name="{{ $row_about->ABOUT_NAME }}"
                                            data-unid="{{ $row_about->UNID }}" onclick="modal_about_data(this)">
                                            {{ $row_about->ABOUT_NAME }}
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('masteredit.footer')
    @include('editpage.modalhome.slide')
    @include('editpage.modalhome.director')
    @include('editpage.modalhome.about')
    <!-- Button trigger modal -->
    <div class="modal fade" id="modal_post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="modal-header bg-primary">
                            <h3 class="modal-title" id="modal_post_title"></h3>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <style>
                            .nav-link-success {
                                background-color: #31ce36 !important;
                                border-color: #31ce36 !important;
                                color: #fff !important;
                            }

                            .btn-clay {
                                background-color: #7c7c7c !important;
                                border-color: #7c7c7c !important;
                                color: #fff !important;

                            }

                            .btn-clay:hover {
                                background-color: #31ce36 !important;
                                border-color: #31ce36 !important;
                                color: #fff !important;

                            }

                            .selected-btn {
                                background-color: #31ce36 !important;
                                border-color: #31ce36 !important;
                                color: #fff !important;
                            }

                            .text-byme-lg {
                                font-size: 20px;
                            }

                            .a-nopoint {
                                cursor: default;
                            }

                        </style>
                        <div class="modal-body">
                            <div class="row">
                                <div class="wizard-container wizard-round col-md-12">
                                    <div class="wizard-body ">
                                        <div class="row">
                                            <ul class="wizard-menu nav nav-pills nav-primary ml-auto mr-auto">
                                                <li class="step">
                                                    <a class="nav-link active text-byme a-nopoint" id="step1_active"
                                                        aria-expanded="true">
                                                        <i class="fa fa-user mr-2"></i>ขั้นตอนแรก ประเถทข้อมูล
                                                    </a>
                                                </li>
                                                <li class="step">
                                                    <a class="nav-link text-byme a-nopoint" id="step2_active">
                                                        <i class="fa fa-file mr-2"></i> ขั้นตอนสอง ตำแหน่งรูปภาพ
                                                    </a>
                                                </li>
                                                <li class="step">
                                                    <a class="nav-link text-byme a-nopoint" id="step3_active">
                                                        <i class="fa fa-map-signs mr-2"></i> ใส่ข้อมูล</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content my-3">
                                            <div class="tab-pane active" id="step1">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h2>ขั้นตอนแรก ประเถทข้อมูล</h2>
                                                    </div>
                                                </div>
                                                <div class="row my-4">
                                                    <div class="col-md-6 text-right ">
                                                        <button type="button" class="btn btn-clay btn-lg text-byme-lg"
                                                            data-typepost="DEFAULT" id="BTN_DEFAULT"
                                                            onclick="post_step1(this)">
                                                            แบบข้อความ</button>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <button type="button" class="btn btn-clay btn-lg text-byme-lg"
                                                            data-typepost="PDF" id="BTN_PDF" onclick="post_step1(this)">
                                                            ไฟล์ หรือ pdf</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="step2">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h2>ขั้นตอนสอง ตำแหน่งรูปภาพ</h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="step3">
                                                <input type="hidden" id="TYPE_POST">
                                                <form data-route="{{ route('post.insert') }}" id="POST_TYPE_DEFAULT"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" id="POSITION_IMG_POST" name="POSITION_IMG_POST">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h2>ขั้นตอนแรก ประเถทข้อมูล</h2>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger mr-auto text-byme" data-dismiss="modal"
                                aria-label="Close" id="POST_BTN_CLOSE">
                                <i class="fas fa-times mx-2"></i>ยกเลิก
                            </button>
                            <button type="button" class="btn btn-danger mr-auto text-byme" data-step="1" id="BTN_RETURN"
                                onclick="return_step(this)" hidden>
                                <i class="fa fa-arrow-left mx-2"></i>ย้อนกลับ
                            </button>
                            <button type="button" class="btn btn-primary text-byme" data-step="2" id="BTN_NEXT"
                                onclick="next_step(this)">
                                <i class="fa fa-arrow-right mr-2" aria-hidden="true"></i>ต่อไป
                            </button>
                            <button type="button" class="btn btn-success text-byme" id="POST_BTN_SUBMIT"
                                onclick="post_submit()" hidden>
                                <i class="fas fa-save mr-2" aria-hidden="true"></i>บันทึก
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
@endsection
@section('java')
    <script src="{{ asset('assets/js/edit/home/director.js') }}"></script>
    <script src="{{ asset('assets/js/edit/home/imgshow.js') }}"></script>
    @include('editpage.javamixphp.about')
    @include('editpage.javamixphp.slide')
    <script>
        $(document).ready(function() {
            // function modal_post(thisdata) {
            // var title = $(thisdata).data('name');
            var title = "เพิ่มข่าวสาร";
            $('#modal_post_title').html(title);
            $('#modal_post').modal('show');
            // }
        });

        function post_step1(thisdata) {
            var type_post = $(thisdata).data('typepost');
            if (type_post == 'DEFAULT') {
                $('#BTN_DEFAULT').addClass('selected-btn');
                $('#BTN_PDF').removeClass('selected-btn');
                $('#TYPE_POST').val(type_post);
            } else if (type_post == 'PDF') {
                $('#BTN_PDF').addClass('selected-btn');

                $('#BTN_DEFAULT').removeClass('selected-btn');
                $('#TYPE_POST').val(type_post);
            }
        }

        function next_step(thisdata) {
            var step = $(thisdata).data('step');
            if (step == 2) {
                $('#POST_BTN_CLOSE').attr('hidden', true);
                $('#BTN_RETURN').attr('hidden', false);
                $('#BTN_NEXT').data('step', 3);
                $('#step1,#step1_active').removeClass('active');
                $('#step2,#step2_active').addClass('active');
                $('#step1_active').addClass('nav-link-success');
            } else if (step == 3) {
                $('#POST_BTN_SUBMIT').attr('hidden', false);
                $('#BTN_NEXT').attr('hidden', true);
                $('#BTN_RETURN').data('step', 2);
                $('#step2,#step2_active').removeClass('active');
                $('#step3,#step3_active').addClass('active');
                $('#step2_active').addClass('nav-link-success');

            }
        }

        function return_step(thisdata) {
            var step = $(thisdata).data('step');
            if (step == 1) {
                $('#POST_BTN_CLOSE').attr('hidden', false);
                $('#BTN_RETURN').attr('hidden', true);
                $('#BTN_NEXT').data('step', 2);
                $('#step2,#step2_active').removeClass('active');
                $('#step1,#step1_active').addClass('active');
                $('#step1_active').removeClass('nav-link-success');
            } else if (step == 2) {
                $('#POST_BTN_SUBMIT').attr('hidden', true);
                $('#BTN_NEXT').attr('hidden', false);
                $('#BTN_NEXT').data('step', 3);
                $('#BTN_RETURN').data('step', 1);
                $('#step3').removeClass('active');
                $('#step3,#step3_active').removeClass('active');
                $('#step2,#step2_active').addClass('active');
                $('#step2_active').removeClass('nav-link-success');
            }
        }

        function post_submit() {

        }
    </script>
@endsection

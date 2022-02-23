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
                                    <img src="{{ asset('assets/image/people/' . $DIRECTOR_IMG) }}" id="SHOW_DIRECTOR"
                                        style="height:299px;width:243px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('director.upload') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-inline">
                                            <input type="file" class="form-control form-control-sm " id="DIRECTOR_IMG"
                                                name="DIRECTOR_IMG" required>
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
                                        {{ isset($DATA_DIRCETOR->DIRCETOR_TEXT) ? $DATA_DIRCETOR->DIRCETOR_TEXT : '' }}
                                    </h3>
                                    <br>
                                    <br>
                                    <h1 class="text-center text-primary" id="DIRECTOR_NAME">
                                        {{ isset($DATA_DIRCETOR->DIRCETOR_TEXT_NAME) ? $DATA_DIRCETOR->DIRCETOR_TEXT_NAME : '' }}
                                    </h1>
                                    <h1 class="text-center text-primary" id="DIRECTOR_SCHOOL">
                                        {{ isset($DATA_DIRCETOR->DIRCETOR_SCHOOL) ? $DATA_DIRCETOR->DIRCETOR_SCHOOL : '' }}
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
                                <div class=" col-md-12 text-white">
                                    <div class="form-inline">
                                        <h1>ข่าวสาร</h1>
                                        <div class="form-group">
                                            <h1 class="mr-2"> ประจำเดือน :</h1>
                                            <select class="form-control text-byme " style="padding: 0.1rem 1rem"
                                                id="SELECT_MONTH_POST" name="SELECT_MONTH_POST">
                                                @php
                                                    $months_full_th = ['0' => 'ทั้งหมด', '1' => 'มกราคม', '2' => 'กุมภาพันธ์', '3' => 'มีนาคม', '4' => 'เมษายน', '5' => 'พฤษภาคม', '6' => 'มิถุนายน', '7' => 'กรกฎาคม', '8' => 'สิงหาคม', '9' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'];
                                                @endphp
                                                @for ($n_month = 0; $n_month <= 12; $n_month++)
                                                    <option value="{{ $n_month }}"
                                                        {{ $n_month == $POST_MONTH ? 'selected' : '' }}>
                                                        {{ $months_full_th[$n_month] }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group  mr-auto">
                                            <h1 class="mr-2"> ประเภทข้อมูล :</h1>
                                            <select class="form-control text-byme " style="padding: 0.1rem 1rem"
                                                id="SELECT_TYPE_POST" name="SELECT_TYPE_POST">
                                                <option value="DEFAULT" {{ $POST_TYPE == 'DEFAULT' ? 'selected' : '' }}>
                                                    ข้อมูลทั่วไป
                                                </option>
                                                <option value="PDF" {{ $POST_TYPE == 'PDF' ? 'selected' : '' }}>
                                                    ข้อมูลPDF
                                                </option>

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
                                <div class="col-md-12">
                                    <div class="row" id="SHOW_POST">
                                        @foreach ($DATA_POST as $index_post => $row_post)
                                            <div class="col-sm-6 col-md-6 col-lg-4 text-center">
                                                <button type="button" class="btn btn-primary btn-lg my-2"
                                                    style="font-size: 1.1625rem;"
                                                    data-name="{{ $row_post->POST_HEADER }}"
                                                    data-unid="{{ $row_post->UNID }}" onclick="modal_about_data(this)">
                                                    {{ $row_post->POST_HEADER }}
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card-footer" style="border-top: 2px solid !important;">
                            <div class="row">
                                <div class="col-md-12" id="PAGINATOR_POST">
                                    {{ $DATA_POST->links('paginator.default') }}

                                </div>
                            </div>
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
                                                <div class="row">
                                                    <div class="col-md-6 my-2 text-right">
                                                        <button type="button"
                                                            class="btn btn-clay btn-lg text-byme-lg TOP post_position"
                                                            data-position="TOP" onclick="post_step2(this)">
                                                            บน</button>
                                                    </div>
                                                    <div class="col-md-6 my-2 text-left">
                                                        <button type="button"
                                                            class="btn btn-clay btn-lg text-byme-lg BOTTON post_position"
                                                            data-position="BOTTON" onclick="post_step2(this)">
                                                            ล่าง</button>
                                                    </div>
                                                    <div class="col-md-6 my-2 text-right">
                                                        <button type="button"
                                                            class="btn btn-clay btn-lg text-byme-lg LEFT post_position"
                                                            data-position="LEFT" onclick="post_step2(this)">
                                                            ซ้าย</button>
                                                    </div>
                                                    <div class="col-md-6 my-2 text-left">
                                                        <button type="button"
                                                            class="btn btn-clay btn-lg text-byme-lg RIGHT post_position"
                                                            data-position="RIGHT" onclick="post_step2(this)">
                                                            ขวา</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="step3">
                                                <form action="{{ route('post.insert.default') }}" id="FRM_POST_DEFAULT"
                                                    method="POST" enctype="multipart/form-data" hidden>
                                                    @csrf
                                                    <input type="hidden" id="POST_TYPE_DEFAULT" name="POST_TYPE_DEFAULT">
                                                    <input type="hidden" id="POST_IMG_POSITION" name="POST_IMG_POSITION">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h2>ใส่ข้อมูล</h2>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>
                                                                <h3>ภาพแสดงตัวอย่าง</h3>
                                                            </label>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="POST_LOGO" name="POST_LOGO">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>
                                                                <h3>ภาพกิจกรรม / ภาพประกอบ </h3>
                                                                **(สามารถเพิ่มหลายรูปได้ โดยการ กด Ctrl ค้างไว้ แล้ว
                                                                คลิกเมาส์ซ้าย)**
                                                            </label>
                                                            <input type="file" class="form-control" id="POST_IMG"
                                                                name="POST_IMG[]" accept="image/*" multiple>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>
                                                                <h3>หัวข้อข่าวสาร</h3>
                                                            </label>
                                                            <input type="text" class="form-control" id="POST_HEADER"
                                                                name="POST_HEADER" placeholder="หัวข้อข่าวสาร">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>
                                                                <h3>คำอธิบาย</h3>
                                                            </label>
                                                            <textarea class="form-control" rows="10" id="POST_BODY"
                                                                name="POST_BODY" placeholder="คำอธิบาย"></textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>
                                                                <h3>ประเภทข่าวสาร</h3>
                                                            </label>
                                                            <select class="form-control" id="POST_TAG" name="POST_TAG">
                                                                <option value="PR">ประชาสัมพันธ์</option>
                                                                <option value="EMP">งานบุคคล</option>
                                                            </select>
                                                        </div>
                                                </form>
                                                <form action="{{ route('post.insert.pdf') }}" id="FRM_POST_PDF"
                                                    method="POST" enctype="multipart/form-data" hidden>
                                                    @csrf
                                                    <input type="hidden" id="POST_TYPE_PDF" name="POST_TYPE_PDF">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h2>ใส่ข้อมูล</h2>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>
                                                                <h3>ภาพแสดงตัวอย่าง</h3>
                                                            </label>
                                                            <input type="file" class="form-control" id="POST_LOGO"
                                                                name="POST_LOGO" accept="image/*">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>
                                                                <h3>อัปโหลดไฟล์PDF</h3>
                                                            </label>
                                                            <input type="file" class="form-control" id="POST_FILE"
                                                                name="POST_FILE" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>
                                                                <h3>หัวข้อข่าวสาร</h3>
                                                            </label>
                                                            <input type="text" class="form-control" id="POST_HEADER"
                                                                name="POST_HEADER" placeholder="หัวข้อข่าวสาร">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>
                                                                <h3>คำอธิบาย</h3>
                                                            </label>
                                                            <textarea class="form-control" rows="5" id="POST_BODY"
                                                                name="POST_BODY" placeholder="คำอธิบาย"></textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>
                                                                <h3>ประเภทข่าวสาร</h3>
                                                            </label>
                                                            <select class="form-control" id="POST_TAG" name="POST_TAG">
                                                                <option value="PR">ประชาสัมพันธ์</option>
                                                                <option value="EMP">งานบุคคล</option>
                                                            </select>
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
@endsection
@section('java')
    <script src="{{ asset('assets/js/edit/home/director.js') }}"></script>
    <script src="{{ asset('assets/js/edit/home/imgshow.js') }}"></script>

    @include('editpage.javamixphp.about')
    @include('editpage.javamixphp.slide')
    <script>
        function modal_post(thisdata) {
            var title = $(thisdata).data('name');
            var title = "เพิ่มข่าวสาร";
            $('#modal_post_title').html(title);
            $('#modal_post').modal('show');
        }

        function post_step2(thisdata) {
            var position = $(thisdata).data('position');
            $('.post_position').removeClass('selected-btn');
            $('.' + position).addClass('selected-btn');
            $('#POST_IMG_POSITION').val(position);
        }

        function post_step1(thisdata) {
            var type_post = $(thisdata).data('typepost');
            if (type_post == 'DEFAULT') {
                $('#BTN_DEFAULT').addClass('selected-btn');
                $('#BTN_PDF').removeClass('selected-btn');
                $('#POST_TYPE_DEFAULT').val(type_post);
                $('#POST_TYPE_PDF').val('');

                $('#FRM_POST_DEFAULT').attr('hidden', false);
                $('#FRM_POST_PDF').attr('hidden', true);
                $('#BTN_NEXT').data('step', 2);
            } else if (type_post == 'PDF') {
                $('#BTN_PDF').addClass('selected-btn');
                $('#BTN_DEFAULT').removeClass('selected-btn');
                $('#POST_TYPE_PDF').val(type_post);
                $('#POST_TYPE_DEFAULT').val('');

                $('#FRM_POST_PDF').attr('hidden', false);
                $('#FRM_POST_DEFAULT').attr('hidden', true);
                $('#BTN_NEXT').data('step', 3);
            }
        }

        function next_step(thisdata) {
            var step = $(thisdata).data('step');
            var check_step_1_default = $('#POST_TYPE_DEFAULT').val();
            var check_step_1_pdf = $('#POST_TYPE_PDF').val();
            if (check_step_1_default != '' || check_step_1_pdf != '') {
                if (step == 2) {
                    $('#POST_BTN_CLOSE').attr('hidden', true);
                    $('#BTN_RETURN').attr('hidden', false);
                    $('#BTN_NEXT').data('step', 3);
                    $('#step1,#step1_active').removeClass('active');
                    $('#step2,#step2_active').addClass('active');
                    $('#step1_active').addClass('nav-link-success');
                } else if (step == 3) {
                    var check_position = $('#POST_IMG_POSITION').val();
                    if (check_step_1_pdf != '') {
                        $('#POST_BTN_CLOSE,#BTN_NEXT').attr('hidden', true);
                        $('#POST_BTN_SUBMIT,#BTN_RETURN').attr('hidden', false);
                        $('#BTN_RETURN').data('step', 1);
                        $('#step1,#step2,#step2_active').removeClass('active');
                        $('#step3,#step3_active').addClass('active');
                        $('#step1_active,#step2_active').addClass('nav-link-success');
                    } else if (check_position != '') {
                        $('#POST_BTN_SUBMIT').attr('hidden', false);
                        $('#BTN_NEXT').attr('hidden', true);
                        $('#BTN_RETURN').data('step', 2);
                        $('#step2,#step2_active').removeClass('active');
                        $('#step3,#step3_active').addClass('active');
                        $('#step2_active').addClass('nav-link-success');
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                            timer: 1500
                        });
                    }
                }
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    timer: 1500
                });
            }

        }

        function return_step(thisdata) {
            var step = $(thisdata).data('step');
            var check_step_1_pdf = $('#POST_TYPE_PDF').val();
            if (step == 1) {
                if (check_step_1_pdf != '') {
                    $('#BTN_NEXT').data('step', 3);

                    $('#POST_BTN_CLOSE,#POST_BTN_SUBMIT').attr('hidden', true);
                    $('#BTN_RETURN,#BTN_NEXT').attr('hidden', false);

                    $('#step2_active').removeClass('nav-link-success');
                    $('#step3,#step3_active').removeClass('active');
                } else {
                    $('#POST_BTN_CLOSE').attr('hidden', false);
                    $('#BTN_RETURN').attr('hidden', true);
                    $('#BTN_NEXT').data('step', 2);
                }
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
            var check_step_1_default = $('#POST_TYPE_DEFAULT').val();
            var check_step_1_pdf = $('#POST_TYPE_PDF').val();
            if (check_step_1_default != '') {
                $('#FRM_POST_DEFAULT').submit();
            } else if (check_step_1_pdf != '') {
                $('#FRM_POST_PDF').submit();
            }
        }
        $('#SELECT_TYPE_POST,#SELECT_MONTH_POST').change(function() {
            var month = $('#SELECT_MONTH_POST').val();
            var type = $('#SELECT_TYPE_POST').val();
            url = "{{ route('edit.home') }}?select_month_post=" + month + "&select_type_post=" + type + "";
            console.log(url);
            location.href = url;
        })

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var check_page = $(this).attr('href');
            var page = $(this).attr('href').split('page=')[1];
            if (check_page == '#') {
                var page = 1;
            }

            fetch_data(page);
        });

        function fetch_data(page) {
            var url = "{{ route('edit.fetch.post') }}?page=" + page + "";
            var month = $('#SELECT_MONTH_POST').val();
            var type = $('#SELECT_TYPE_POST').val();
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    select_month_post: month,
                    select_type_post: type,
                },
                success: function(response) {
                    var id_url = "{{ route('edit.home') }}?page=" + page + "";
                    var next_url = "{{ route('edit.home') }}?page=" + response.next_page + "";
                    var previous_url = "{{ route('edit.home') }}?page=" + response.previous_page + "";

                    $('#SHOW_POST').html(response.fetchpost);
                    $('.number_paginate').find('a').removeClass('active');
                    if (page == 1) {
                        $('.number_paginate').find('[href*="#"]').addClass('active');
                    } else {
                        $('.number_paginate').find('[href*="' + id_url + '"]').addClass('active');

                    }
                    $('.next').attr('href', next_url);
                    $('.previous_url').attr('href', previous_url);

                }
            });
        }
    </script>
@endsection

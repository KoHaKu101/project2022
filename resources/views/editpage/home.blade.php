@extends("masteredit.master")
@section('content')
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
                                    <img src="{{ asset('assets/image/slideshow/' . $IMG__PATH) }}" class="w-100">
                                    <h4>ภาพไสด์ที่ {{ $i }}</h4>
                                    <div class="row">
                                        @if (isset($IMG->IMG_FILE))
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-warning btn-sm text-center btn-self btn-block"
                                                    onclick="modalslide(this)" data-number="{{ $i }}">
                                                    แก้ไข
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm text-center btn-self btn-block"
                                                    onclick="delete_slide_img(this)" data-number="{{ $i }}">
                                                    ลบรูป
                                                </button>
                                            </div>
                                        @else
                                            <div class="col-md-12">
                                                <button type="button"
                                                    class="btn btn-warning btn-sm text-center btn-self btn-block"
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
                                            <button type="submit" class="btn btn-success btn-sm my-2 ml-2 text-byme">
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
                                <div class="col-md-6">
                                    <h1 class="text-white">สาส์นจากผู้อำนวยการ</h1>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-warning btn-sm text-byme" onclick="director()">
                                        แก้ไขข้อความ</button>
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
                                <div class="col-md-6 text-left text-white">
                                    <h1>เกี่ยวกับโรงเรียน</h1>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-warning text-byme" onclick="modal_about(this)"
                                        data-name="เพิ่มข้อมูล">
                                        <i class="fas fa-plus"></i>
                                        เพิ่มข้อมูล
                                    </button>
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
    <div class="modal fade" id="modal_about" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="modal-header bg-primary">
                            <h3 class="modal-title" id="MODAL_NAME_ABOUT"></h3>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="FRM_ABOUT" action="{{ route('about.insert') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="ABOUT_POSITION" name="ABOUT_POSITION" value="RIGHT">
                                <input type="hidden" id="ABOUT_UNID" name="ABOUT_UNID">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group has-error">
                                            <label>หัวข้อ</label>
                                            <input type="text" class="form-control " id="ABOUT_NAME" name="ABOUT_NAME"
                                                placeholder="กรุณาใส่หัวขอ เช่น ความเป็นมาของศูนย์" required>
                                        </div>
                                    </div>
                                    <style>
                                        .btn-disabled {
                                            cursor: not-allowed;
                                        }

                                    </style>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="form-group">
                                                <label>ตำแหน่งของภาพ</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-primary btn-block"
                                                            onclick="about_postion(this)" id="BTN_LEFT"
                                                            data-position="LEFT">ภาพอยู่ซ้ายมือ</button>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <button type="button" class="btn btn-primary btn-block btn-disabled"
                                                            onclick="about_postion(this)" id="BTN_RIGHT"
                                                            data-position="RIGHT" disabled>ภาพอยู่ขวามือ</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" id="DIV_RIGHT">
                                        <div class="form-group has-error">
                                            <label>ข้อมูล</label>
                                            <textarea class="form-control" rows="14" required
                                                placeholder="กรุณาใส่ข้อมูลในนี้" id="ABOUT_TEXT"
                                                name="ABOUT_TEXT"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="DIV_LEFT">
                                        <div class="form-group ">
                                            <label>ภาพ</label>
                                            <input type="file" class="form-control" id="ABOUT_IMG" name="ABOUT_IMG">
                                            <div class="div_img">
                                                <img src="{{ asset('assets/image/postmassage/no_img.png') }}"
                                                    id="SHOWABOUT_IMG" style="width: -webkit-fill-available;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger mr-auto text-byme" data-dismiss="modal"
                                aria-label="Close"><i class="fas fa-times mx-2"></i>ยกเลิก</button>
                            <button type="button" class="btn btn-danger" hidden id="BTN_DELETE_ABOUT" data-unid=""
                                onclick="deleteabout(this)">
                                <i class="fas fa-trash mx-2"></i>ลบ
                            </button>
                            <button type="button" class="btn btn-success text-byme" id="BTN_SUBMIT_ABOUT"
                                onclick="submit_about()">
                                <i class="fas fa-save mx-2"></i>บันทึก</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
@endsection
@section('java')
    <script src="{{ asset('assets/js/edit/home/slide.js') }}"></script>
    <script src="{{ asset('assets/js/edit/home/director.js') }}"></script>
    <script src="{{ asset('assets/js/edit/home/imgshow.js') }}"></script>
    <script>
        $('#modal_about').on('hidden.bs.modal', function() {

            var url_insert = "{{ route('about.insert') }}";
            var asset_make = "{{ asset('/') }}" + 'assets/image/postmassage/no_img.png';
            $('.div_img').html('<img src="' + asset_make +
                '"id = "SHOWABOUT_IMG" style = "width: -webkit-fill-available;" > ');
            $('#BTN_SUBMIT_ABOUT').html('<i class="fas fa-save mx-2"></i>บันทึก');
            $('#BTN_RIGHT').click();
            $('#FRM_ABOUT').attr('action', url_insert);
            $('#BTN_DELETE_ABOUT').attr('data-unid', '');
            $('#ABOUT_UNID').val('');
            $('#BTN_DELETE_ABOUT').attr('hidden', true);
            $('#FRM_ABOUT')[0].reset();
        })

        function modal_about(thisdata) {
            var MODAL_TITLE = $(thisdata).data('name');
            $('#MODAL_NAME_ABOUT').html(MODAL_TITLE);
            $('#modal_about').modal('show');
        }

        function modal_about_data(thisdata) {
            var MODAL_TITLE = $(thisdata).data('name');
            var UNID = $(thisdata).data('unid');
            var url = "{{ route('about.show') }}";
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    ABOUT_UNID: UNID
                },
                success: function(response) {
                    if (response.status == 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'กรุณาติดต่อแอดมินหรือลองใหม่อีกครั้ง',
                        });
                    } else {
                        var url_update = "{{ route('about.update') }}";
                        $('#MODAL_NAME_ABOUT').html('แก้ไข : ' +
                            MODAL_TITLE);
                        $('#ABOUT_UNID').val(UNID);
                        $('#ABOUT_NAME').val(response.ABOUT_NAME);
                        $('#ABOUT_TEXT').val(response.ABOUT_TEXT);
                        $('#BTN_DELETE_ABOUT').attr('data-unid', UNID);
                        $('#FRM_ABOUT').attr('action', url_update);
                        var asset_make = "{{ asset('/') }}" + 'assets/image/postmassage/no_img.png';
                        if (response.ABOUT_IMG != '') {
                            asset_make = "{{ asset('/assets/image/about') }}/" + response.ABOUT_IMG;
                        }
                        $('.div_img').html('<img src="' + asset_make +
                            '"id = "SHOWABOUT_IMG" style = "width: -webkit-fill-available;" > ');
                        $('#BTN_' + response.ABOUT_POSTION).click();
                        $('#BTN_SUBMIT_ABOUT').html('<i class="fas fa-edit mx-2"></i>แก้ไข');
                        $('#BTN_DELETE_ABOUT').attr('hidden', false);
                        $('#modal_about').modal('show');
                    }
                }
            });

        }

        function about_postion(thisdata) {
            var position_show = $(thisdata).data('position');
            var position_hide = position_show == 'RIGHT' ? 'LEFT' : 'RIGHT';
            $("#DIV_" + position_hide).before($("#DIV_" + position_show));
            $('#BTN_' + position_show).attr('disabled', true);
            $('#BTN_' + position_show).addClass('btn-disabled');
            $('#BTN_' + position_hide).attr('disabled', false);
            $('#BTN_' + position_hide).addClass('btn-disabled');
            $('#ABOUT_POSITION').val(position_show);
        }
        $("#ABOUT_IMG").change(function() {
            var id_img_left = 'SHOWABOUT_IMG';
            readURL(this, id_img_left);
        });

        function submit_about() {
            $('#FRM_ABOUT').submit();
        }

        function deleteabout(thisdata) {
            var UNID = $(thisdata).data('unid');
            var url = "{{ route('about.delete') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    UNID: UNID
                },
                success: function(response) {
                    console.log('success');
                }
            });
        }
    </script>
@endsection

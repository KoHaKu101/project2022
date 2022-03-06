@extends('masteredit.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/edithome.css') }}">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
@section('content')
    <style>
        .text-byme {
            font-size: 16px;
        }

        .dis {
            pointer-events: none;
            cursor: default;
        }

        .card .card-footer {
            border-top: 2px solid #000000 !important;
        }

        .select2-container--default .select2-selection--multiple {
            border-color: #f25961 !important;
            color: #f25961 !important;
        }

        span.select2-selection--multiple[aria-expanded=true] {
            border-color: #f25961 !important;
            color: #f25961 !important;
        }

    </style>
    <div class="content">
        <div class="page-inner py-3">
            <div class="card">
                <div class="card-header bg-purple text-white">
                    <div class="row">
                        <div class="col-md-12 form-inline">
                            <a href="{{ route('edit.post') }}" class="btn btn-warning mr-4 text-byme">
                                <i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ
                            </a>
                            <h1>ป้ายแสดงกลุ่มข้อมูล</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 has-error mx-auto">
                            <h3 class="text-danger"> ประเภทข่าวสาร </h3>
                            <div class="form-group">
                                <button type="button" id="DEFAULT"
                                    class="btn btn-clay mx-1 {{ $DATA_POST->POST_TYPE == 'DEFAULT' ? 'selected-btn' : '' }}"
                                    onclick="select_type(this)" data-type="DEFAULT">
                                    <h4> ข้อความปกติ</h4>
                                </button>
                                <button type="button" id="PDF"
                                    class="btn btn-clay mx-1 {{ $DATA_POST->POST_TYPE == 'PDF' ? 'selected-btn' : '' }}"
                                    onclick="select_type(this)" data-type="PDF">
                                    <h4>ไฟล์ PDF</h4>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 has-error mx-auto" {{ $DATA_POST->POST_TYPE == 'DEFAULT' ? '' : 'hidden' }}
                            id="IMG_POSITION">
                            <h3 class="text-danger">ตำแหน่งรูปภาพ</h3>
                            <div class="form-group">
                                <button type="button" id="TOP"
                                    class="btn btn-clay btn-position mx-1 my-1
                                    {{ isset($DATA_IMG[0]->POST_IMG_POSITION)? ($DATA_IMG[0]->POST_IMG_POSITION == 'TOP'? 'selected-btn': ''): '' }}"
                                    onclick="select_position(this)" data-position="TOP">
                                    <h4> ตำแหน่งภาพบน</h4>
                                </button>
                                <button type="button" id="BOTTON"
                                    class="btn btn-clay btn-position mx-1 my-1
                                    {{ isset($DATA_IMG[0]->POST_IMG_POSITION)? ($DATA_IMG[0]->POST_IMG_POSITION == 'BOTTON'? 'selected-btn': ''): '' }}"
                                    onclick="select_position(this)" data-position="BOTTON">
                                    <h4>ตำแหน่งภาพล่าง</h4>
                                </button>
                                <button type="button" id="LEFT"
                                    class="btn btn-clay btn-position mx-1 my-1
                                    {{ isset($DATA_IMG[0]->POST_IMG_POSITION)? ($DATA_IMG[0]->POST_IMG_POSITION == 'LEFT'? 'selected-btn': ''): '' }}"
                                    onclick="select_position(this)" data-position="LEFT">
                                    <h4> ตำแหน่งภาพซ้าย</h4>
                                </button>
                                <button type="button" id="RIGHT"
                                    class="btn btn-clay btn-position mx-1 my-1
                                    {{ isset($DATA_IMG[0]->POST_IMG_POSITION)? ($DATA_IMG[0]->POST_IMG_POSITION == 'RIGHT'? 'selected-btn': ''): '' }}"
                                    onclick="select_position(this)" data-position="RIGHT">
                                    <h4>ตำแหน่งภาพขวา</h4>
                                </button>
                            </div>
                        </div>
                    </div>
                    <h2 class="mt-4"><u>เนื้อหาข้อมูลต่างๆ</u></h2>
                    <form action="{{ route('post.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="UNID" name="UNID" value="{{ $DATA_POST->UNID }}">
                        <input type="hidden" id="POST_TYPE" name="POST_TYPE" value="{{ $DATA_POST->POST_TYPE }}">
                        <input type="hidden" id="POST_IMG_POSITION" name="POST_IMG_POSITION"
                            value="{{ isset($DATA_IMG[0]->POST_IMG_POSITION) ? $DATA_IMG[0]->POST_IMG_POSITION : null }}">
                        <div class="card-footer">
                            <div class="row my-2">
                                <div class="col-md-6 text-center">
                                    <img src="{{ asset('assets/image/post/logo/' . $DATA_POST->POST_IMG_LOGO . $DATA_POST->POST_IMG_EXT) }}"
                                        class="img-fluid" style="width:263px;height:190px">
                                </div>
                                <div class="col-md-6 ">
                                    <h3 class="text-danger">รูปภาพโลโก้ / รูปภาพปกข่าว</h3>
                                    <input type="file" class="form-control" id="POST_IMG_LOGO" name="POST_IMG_LOGO"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="row my-2" id="div_img"
                                {{ isset($DATA_IMG[0]->POST_IMG_POSITION) ? '' : 'hidden' }}>
                                <div class="col-md-6  div-img">
                                    <div class="form-group form-inline ">
                                        @if (isset($DATA_IMG[0]->POST_IMG_POSITION))
                                            @foreach ($DATA_IMG as $index_img => $row_img)
                                                <img src="{{ asset('assets/image/post/img/' . $row_img->POST_IMG_NAME . $row_img->POST_IMG_EXT) }}"
                                                    class="img-fluid mx-1 my-1 mx-auto" style="width:200px;height:147px">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 div-img ">
                                    <h3 class="text-danger">รูปภาพช้อมูลต่างๆ</h3>
                                    <input type="file" class="form-control" id="POST_IMG" name="POST_IMG[]"
                                        accept="image/jpg,png,jpeg" multiple>
                                </div>
                            </div>
                            <div class="row my-2" id="div_pdf"
                                {{ !isset($DATA_IMG[0]->POST_IMG_POSITION) ? '' : 'hidden' }}>
                                <div class="col-md-6">
                                    @if (!isset($DATA_IMG[0]->POST_IMG_POSITION))
                                        <embed
                                            src="{{ asset('assets/pdf/post/' . $DATA_POST->POST_PDF . $DATA_POST->POST_PDF_EXT) }}"
                                            type="application/pdf" style="width:100%;height:200px">
                                        <button type="button" class="btn btn-secondary my-2 btn-block text-byme"
                                            onclick="open_pdf(this)"
                                            data-name="{{ $DATA_POST->POST_PDF . $DATA_POST->POST_PDF_EXT }}">
                                            <i class="fas fa-external-link-square-alt mr-2"></i>เปิดไฟล์
                                        </button>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h3 class="text-danger">ไฟล์ PDF</h3>
                                    <input type="file" class="form-control" id="POST_FILE_PDF" name="POST_FILE_PDF"
                                        accept="application/pdf">
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-12 has-error">
                                    <h3 class="text-danger">หัวข้อข่าวสาร</h3>
                                    <input type="text" class="form-control" id="POST_HEADER" name="POST_HEADER"
                                        value="{{ $DATA_POST->POST_HEADER }}" required>
                                </div>

                            </div>
                            <div class="row my-2">
                                <div class="col-md-12 has-error">
                                    <h3 class="text-danger">คำอธิบาย</h3>
                                    <textarea class="form-control" rows="8" id="POST_BODY" name="POST_BODY"
                                        required>{{ $DATA_POST->POST_BODY }}</textarea>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-12 has-error ">
                                    <h3 class="text-danger">กลุ่มข่าวสาร</h3>
                                    <select class='form-control js-example-basic-multiple' id='POST_TAG' name='POST_TAG[]'
                                        hidden multiple='multiple'>
                                        @foreach ($DATA_TAG as $index_tag => $row_tag)
                                            @php
                                                $CEHCK_SELECTED = $POST_TAG->where('UNID_TAG', '=', $row_tag->UNID)->first();
                                                $SELECTED = isset($CEHCK_SELECTED->UNID_TAG) ? 'selected' : '';
                                            @endphp
                                            <option value="{{ $row_tag->UNID }}" {{ $SELECTED }}>
                                                {{ $row_tag->TAG_NAME }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 form-inline">
                                    <button type="submit" class="btn btn-success ml-auto">
                                        <i class="fas fa-save mr-2"></i>บันทึก
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
@endsection
@section('java')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#POST_TAG').attr('hidden', false);
            $('.js-example-basic-multiple').select2({
                width: '100%',
            });
            $('.js-example-basic-multiple').trigger('change');
        });

        function select_type(thisdata) {
            var type = $(thisdata).data('type');
            $('#POST_TYPE').val(type);
            if (type == 'DEFAULT') {
                $('#DEFAULT').addClass('selected-btn');
                $('#PDF').removeClass('selected-btn');
                $('#IMG_POSITION').attr('hidden', false);
                $('#div_img').attr('hidden', false);
                $('#div_pdf').attr('hidden', true);

            } else {
                $('#PDF').addClass('selected-btn');
                $('#DEFAULT').removeClass('selected-btn');
                $('#IMG_POSITION').attr('hidden', true);
                $('#POST_IMG_POSITION').val();
                $('.btn-position').removeClass('selected-btn');
                $('#div_pdf').attr('hidden', false);
                $('#div_img').attr('hidden', true);

            }
        }

        function select_position(thisdata) {
            var position = $(thisdata).attr('data-position');
            $('#POST_IMG_POSITION').val(position);
            $('.btn-position').removeClass('selected-btn');
            $('#' + position).addClass('selected-btn');
        }

        function open_pdf(thisdata) {
            var file_name = $(thisdata).data('name');
            var url = "{{ asset('assets/pdf/post/') }}" + "/" + file_name;
            window.open(url, 'name');
        }
    </script>
@endsection

@extends("masteredit.master")
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/edithome.css') }}">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="content">
        <div class="page-inner py-3">
            <div class="card">
                <div class="card-header bg-purple text-white">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-inline">
                                <a href="{{ route('edit.school.show', ['UNID' => $DATA_DETAIL_SCHOOL->UNID_REF]) }}"
                                    class="btn btn-danger mr-2 text-byme"><i
                                        class="fas fa-arrow-alt-circle-left mr-1"></i>ย้อนกลับ</a>
                                <h1>ข้อมูลพื้นฐานของ : {{ $DATA_DETAIL_SCHOOL->DETAIL_HEAD }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('edit.school.update_detail') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="UNID" name="UNID" value="{{ $DATA_DETAIL_SCHOOL->UNID }}">
                        <input type="hidden" id="DELETE_IMG" name="DELETE_IMG"
                            value="{{ isset($DATA_DETAIL_SCHOOL->DETAIL_IMG_POSITION) ? 'false' : 'true' }}">
                        <div class="row">
                            <div class="col-md-12 has-error">
                                <h2 class="text-center">หัวข้อข้อมูล เช่น วิสัยทัศ</h2>
                                <input type="text" class="form-control" id="DETAIL_HEAD" name="DETAIL_HEAD"
                                    placeholder="หัวข้อข้อมูล เช่น วิสัยทัศ"
                                    value="{{ $DATA_DETAIL_SCHOOL->DETAIL_HEAD }}" required>
                            </div>
                        </div>
                        @php
                            $position = isset($DATA_DETAIL_SCHOOL->DETAIL_IMG_POSITION) ? $DATA_DETAIL_SCHOOL->DETAIL_IMG_POSITION : '';
                            $img = isset($DATA_DETAIL_SCHOOL->DETAIL_IMG_POSITION) ? $DATA_DETAIL_SCHOOL->DETAIL_IMG . $DATA_DETAIL_SCHOOL->DETAIL_IMG_EXT : '';
                            $img_src = '<h4>รูปภาพถ้ามี</h4>' . '<img src="' . asset('assets/image/school/' . $DETAIL_TYPE . '/' . $img) . '" class="img-fluid">' . '<h4>ใส่รูปภาพ</h4>' . '<input type="file" class="form-control" id="DETAIL_IMG" name="DETAIL_IMG" >     ';
                        @endphp
                        <div class="row ">
                            <div class="col-md-12 my-3 form-inline">
                                <h2 class="ml-auto">ข้อมูลหรือเนื้อหาของหัวข้อ</h2>
                                <button type="button" class="btn btn-warning mx-3 "
                                    onclick="img_select(this)">ตำแหน่งรูป</button>
                                <button type="button" class="btn btn-danger mx-3 mr-auto"
                                    onclick="img_remove(this)">ลบรูป</button>
                            </div>
                            <div class="col-md-12 has-error text-center" id="IMG_TOP"
                                {{ $position == 'TOP' ? '' : 'hidden' }}>
                                {!! $position == 'TOP' ? $img_src : '' !!}
                            </div>
                            <div class="col-md-6 has-error" id="IMG_LEFT" {{ $position == 'LEFT' ? '' : 'hidden' }}>
                                {!! $position == 'LEFT' ? $img_src : '' !!}
                            </div>
                            {{-- เนื้อหา --}}

                            <div class="{{ $position == 'LEFT' || $position == 'RIGHT' ? 'col-md-6' : 'col-md-12' }} has-error"
                                id="DIV_DEATIL_TEXT">
                                <h4 class="text-danger">เนื้อหา (**** หากต้องการทำย่อหน้าให้ทำการใช้
                                    (_____)แทนการย่อหน้าหรือเว้นระยะที่มีความยาวมากๆ ****)</h4>
                                <textarea class="form-control " rows="20" placeholder="เนื้อหาข้อมูลต่างๆ" id="DETAIL_TEXT"
                                    name="DETAIL_TEXT" required>{!! $DATA_DETAIL_SCHOOL->DETAIL_TEXT !!}</textarea>
                            </div>
                            {{-- เนื้อหา --}}
                            <div class="col-md-6 has-error" id="IMG_RIGHT" {{ $position == 'RIGHT' ? '' : 'hidden' }}>
                                {!! $position == 'RIGHT' ? $img_src : '' !!}
                            </div>
                            <div class="col-md-12 has-error text-center" id="IMG_BOTTON"
                                {{ $position == 'BOTTON' ? '' : 'hidden' }}>
                                {!! $position == 'BOTTON' ? $img_src : '' !!}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('edit.school') }}" class="btn btn-danger mr-2 text-byme"><i
                                        class="fas fa-times mr-1"></i>ยกเลิก</a>
                                <button type="submit" class="btn btn-success"><i
                                        class="fas fa-save mr-2"></i>บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="img_select" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple text-white">
                    <h3 class="modal-title">ตำแหน่งรูปภาพ</h3>
                    <button type="button" class="close text-white " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>ตำแหน่งรูปภาพ</h3>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-6 my-2 text-right">
                            <button type="button" class="btn btn-clay btn-lg text-byme-lg TOP img_position"
                                data-position="TOP" onclick="img_position(this)">
                                บน</button>
                        </div>
                        <div class="col-md-6 my-2 text-left">
                            <button type="button" class="btn btn-clay btn-lg text-byme-lg BOTTON img_position"
                                data-position="BOTTON" onclick="img_position(this)">
                                ล่าง</button>
                        </div>
                        <div class="col-md-6 my-2 text-right">
                            <button type="button" class="btn btn-clay btn-lg text-byme-lg LEFT img_position"
                                data-position="LEFT" onclick="img_position(this)">
                                ซ้าย</button>
                        </div>
                        <div class="col-md-6 my-2 text-left">
                            <button type="button" class="btn btn-clay btn-lg text-byme-lg RIGHT img_position"
                                data-position="RIGHT" onclick="img_position(this)">
                                ขวา</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times mr-2" onclick="cancel_position()"></i>
                        ยกเลิก
                    </button>
                    <button type="button" class="btn btn-success" onclick="save_position()">
                        <i class="fa fa-check mr-2"></i>
                        ตกลง
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('java')
    <script>
        function img_select() {
            $('#img_select').modal('show');
        }

        function img_position(thisdata) {
            var position = $(thisdata).data('position');
            $('.img_position').removeClass('selected-btn');
            $('.' + position).addClass('selected-btn');
        }

        function cancel_position() {
            $('#img_select').modal('hide');
        }

        function save_position() {
            var position = $('.selected-btn').data('position');
            if (position == null) {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณาเลือกหนึ่งตำแหน่ง',
                    timer: '2000',
                })
                return false;

            }
            var size = '';
            var img_get = $('.img-fluid').attr('src');
            var img = img_get != null ? img_get : "{{ asset('assets/image/school/no_image.png') }}";
            $('#IMG_TOP').empty();
            $('#IMG_LEFT').empty();
            $('#IMG_RIGHT').empty();
            $('#IMG_BOTTON').empty();
            if (position == 'TOP' || position == 'BOTTON') {
                size = 'width="50%"';
                $('#DIV_DEATIL_TEXT').removeClass('col-md-6');
                $('#DIV_DEATIL_TEXT').addClass('col-md-12');
            } else {
                $('#DIV_DEATIL_TEXT').removeClass('col-md-12');
                $('#DIV_DEATIL_TEXT').addClass('col-md-6');
            }
            var html = '<h4>รูปภาพถ้ามี</h4>' +
                '<img src="' + img + '" class="img-fluid " ' + size + '>' +
                '<h4>ใส่รูปภาพ</h4>' +
                '<input type="hidden" class="form-control" id="DETAIL_IMG_POSITION" name="DETAIL_IMG_POSITION"' +
                'value="' + position + '">' +
                '<input type="file" class="form-control" id="DETAIL_IMG" name="DETAIL_IMG" >';
            $('#IMG_' + position).attr('hidden', false);
            $('#IMG_' + position).html(html);
            $('#DELETE_IMG').val('false');
            $('#img_select').modal('hide');
        }

        function img_remove() {
            $('#IMG_TOP').empty();
            $('#IMG_LEFT').empty();
            $('#IMG_RIGHT').empty();
            $('#IMG_BOTTON').empty();
            $('#DIV_DEATIL_TEXT').removeClass('col-md-6');
            $('#DIV_DEATIL_TEXT').addClass('col-md-12');
            $('#DELETE_IMG').val('true');
        }
    </script>
@endsection

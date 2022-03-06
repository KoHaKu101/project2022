@extends("masteredit.master")
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/edithome.css') }}">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <style>
        .text-detail {}

    </style>
    <div class="content">
        <div class="page-inner py-3">
            <div class="card">
                <div class="card-header bg-purple text-white">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-inline">
                                <a href="{{ route('edit.school') }}" class="btn btn-danger mr-2 text-byme"><i
                                        class="fas fa-arrow-alt-circle-left mr-1"></i>ย้อนกลับ</a>
                                <h1>ข้อมูลพื้นฐานของ : {{ $DATA_DETAIL->DETAIL_HEAD }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($DATA_DETAIL_SCHOOL->count() > 0)
                    <div class="card-body">
                        @foreach ($DATA_DETAIL_SCHOOL as $index => $row)
                            @php
                                $position = $row->DETAIL_IMG_POSITION;
                                $img = asset('assets/image/school/' . $DATA_DETAIL->DETAIL_TYPE . '/' . $row->DETAIL_IMG . $row->DETAIL_IMG_EXT);
                            @endphp
                            <div class="row">
                                <div class="col-md-12 ">
                                    <h1 class="text-center">{{ $row->DETAIL_HEAD }}</h1>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12 text-center" {{ $position == 'TOP' ? '' : 'hidden' }}>
                                    {!! isset($position) ? '<img src="' . $img . '" class="img-fluid" widht="50%">' : '' !!}
                                </div>
                                <div class="col-md-6 " {{ $position == 'LEFT' ? '' : 'hidden' }}>
                                    {!! isset($position) ? '<img src="' . $img . '" class="img-fluid">' : '' !!}
                                </div>
                                {{-- เนื้อหา --}}
                                <div class="{{ $position == 'RIGHT' || $position == 'LEFT' ? 'col-md-6' : 'col-md-12' }}">
                                    <h3 class="text-detail">{!! nl2br($row->DETAIL_TEXT) !!} </h3>
                                </div>
                                {{-- เนื้อหา --}}
                                <div class="col-md-6 " {{ $position == 'RIGHT' ? '' : 'hidden' }}>
                                    {!! isset($position) ? '<img src="' . $img . '" class="img-fluid">' : '' !!}
                                </div>
                                <div class="col-md-12  text-center" {{ $position == 'BOTTON' ? '' : 'hidden' }}>
                                    {!! isset($position) ? '<img src="' . $img . '" class="img-fluid" widht="50%">' : '' !!}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('edit.school.show_edit', ['UNID' => $row->UNID]) }}"
                                        class="btn btn-warning"><i class="fas fa-edit mr-2"></i>แก้ไข</a>
                                    <button type="button" class="btn btn-danger" onclick="remove_detail(this)"
                                        data-unid="{{ $row->UNID }}" data-name="{{ $row->DETAIL_HEAD }}">
                                        <i class="fas fa-trash mr-2"></i>ลบ
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div style="border-top: 2px solid !important;">
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('edit.school.insert_detail') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="UNID_REF" name="UNID_REF" value="{{ $DATA_DETAIL->UNID }}">
                        <div class="row">
                            <div class="col-md-12 has-error">
                                <h2 class="text-center">หัวข้อข้อมูล เช่น วิสัยทัศ</h2>
                                <input type="text" class="form-control" id="DETAIL_HEAD" name="DETAIL_HEAD"
                                    placeholder="หัวข้อข้อมูล เช่น วิสัยทัศ" required>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12 my-3 form-inline">
                                <h2 class="ml-auto">ข้อมูลหรือเนื้อหาของหัวข้อ</h2>
                                <button type="button" class="btn btn-warning mx-3 "
                                    onclick="img_select(this)">เพิ่มรูปภาพ</button>
                                <button type="button" class="btn btn-danger mx-3 mr-auto"
                                    onclick="img_remove(this)">ลบรูป</button>
                            </div>
                            <div class="col-md-12 has-error text-center" id="IMG_TOP" hidden></div>
                            <div class="col-md-6 has-error" id="IMG_LEFT" hidden></div>
                            {{-- เนื้อหา --}}
                            <div class="col-md-12 has-error" id="DIV_DEATIL_TEXT">
                                <h4 class="text-danger">เนื้อหา (หากต้องการทำย่อหน้าให้ทำการใช้
                                    (_____)แทนการย่อหน้าหรือเว้นระยะที่มีความยาวมากๆ)</h4>
                                <textarea class="form-control " rows="20" placeholder="เนื้อหาข้อมูลต่างๆ" id="DETAIL_TEXT"
                                    name="DETAIL_TEXT" required></textarea>
                            </div>
                            {{-- เนื้อหา --}}
                            <div class="col-md-6 has-error" id="IMG_RIGHT" hidden></div>
                            <div class="col-md-12 has-error text-center" id="IMG_BOTTON" hidden></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 text-right">
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
                '<input type="file" class="form-control" id="DETAIL_IMG" name="DETAIL_IMG" required>';
            $('#IMG_' + position).attr('hidden', false);
            $('#IMG_' + position).html(html);
            $('#img_select').modal('hide');
        }

        function img_remove() {
            $('#IMG_TOP').empty();
            $('#IMG_LEFT').empty();
            $('#IMG_RIGHT').empty();
            $('#IMG_BOTTON').empty();
        }

        function remove_detail(thisdata) {
            var name = $(thisdata).data('name');
            Swal.fire({
                icon: 'warning',
                title: 'คุณต้องการลบ : ' + name + ' มั้ย ?',
                showConfirmlButton: true,
                confirmButtonText: 'ลบ',
                showCancelButton: true,
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#31ce36',
                cancelButtonColor: '#f25961',
            }).then((result) => {
                if (result.isConfirmed) {
                    var unid = $(thisdata).data('unid');
                    var url = "{{ route('edit.school.delete_detail') }}";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            UNID: unid
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบรายการสำเร็จ',
                                timer: '1500',
                            }).then(function() {
                                location.reload();
                            })
                        }
                    });
                }
            })
        }
    </script>
@endsection

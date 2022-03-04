@extends("masteredit.master")
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/edithome.css') }}">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <style>
        label {
            font-size: 16px !important
        }

        .form-control {
            font-size: 16px !important
        }

        .row.has-error {
            padding-top: 5px;
            padding-bottom: 5px;
        }

    </style>
    <div class="content">
        <div class="page-inner py-3">
            <div class="card">
                <div class="card-header bg-purple text-white">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-inline">
                                <a href="{{ route('edit.emp') }}" class="btn btn-warning text-byme mr-2">
                                    <i class="fas fa-arrow-alt-circle-left mr-1"></i>ย้อนกลับ
                                </a>
                                <h1>พนักงาน</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('empschool.update', ['UNID' => $DATA_EMP->UNID]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-body">
                                @php
                                    $img = isset($DATA_EMP->EMP_IMG) ? $DATA_EMP->EMP_IMG . $DATA_EMP->EMP_IMG_EXT : 'noimg.jpg';
                                @endphp
                                <img src="{{ asset('assets/image/emp/' . $img) }}" class="img-fluid" id="IMG_SHOW">
                                <label class="my-2">อัพโหลดรูป</label>
                                <input type="file" class="form-control" id="FILE_IMG" name="FILE_IMG">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="row has-error">
                                    <div class="col-md-6">
                                        <label>ชื่อต้นภาษาไทย ***</label>
                                        <input type="text" class="form-control" id="EMP_FIRST_NAME_TH"
                                            name="EMP_FIRST_NAME_TH" required value="{{ $DATA_EMP->EMP_FIRST_NAME_TH }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>นามสกุลภาษาไทย ***</label>
                                        <input type="text" class="form-control" id="EMP_LAST_NAME_TH"
                                            name="EMP_LAST_NAME_TH" required value="{{ $DATA_EMP->EMP_LAST_NAME_TH }}">
                                    </div>

                                </div>
                                <div class="row has-error">
                                    <div class="col-md-6">
                                        <label>ชื่อต้นภาษาอังกฤษ</label>
                                        <input type="text" class="form-control" id="EMP_FIRST_NAME_EN"
                                            name="EMP_FIRST_NAME_EN" value="{{ $DATA_EMP->EMP_FIRST_NAME_EN }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>นามสกุลภาษาอังกฤษ</label>
                                        <input type="text" class="form-control" id="EMP_LAST_NAME_EN"
                                            name="EMP_LAST_NAME_EN" value="{{ $DATA_EMP->EMP_FIRST_NAME_EN }}">
                                    </div>

                                </div>
                                <div class="row has-error">
                                    <div class="col-md-3">
                                        <label>คำนำหน้า ***</label>
                                        <input type="text" class="form-control" id="EMP_PREFIX" name="EMP_PREFIX" required
                                            value="{{ $DATA_EMP->EMP_PREFIX }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label>อายุ ***</label>
                                        <div class="input-group mb-3">
                                            <input type="nubmer" class="form-control" id="EMP_AGE" name="EMP_AGE" required
                                                value="{{ $DATA_EMP->EMP_AGE }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">ปี</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>เพศ ***</label>
                                        <select class="form-control" id="EMP_SEX" name="EMP_SEX" required>
                                            <option value="ชาย" {{ $DATA_EMP->EMP_SEX == 'ชาย' ? 'selected' : '' }}>
                                                ชาย
                                            </option>
                                            <option value="หญิง" {{ $DATA_EMP->EMP_SEX == 'หญิง' ? 'selected' : '' }}>
                                                หญิง
                                            </option>
                                            <option value="ไม่มีเพศ"
                                                {{ $DATA_EMP->EMP_SEX == 'ไม่มีเพศ' ? 'selected' : '' }}>
                                                ไม่มีเพศ
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>สัญชาติ ***</label>
                                        <input type="text" class="form-control" id="EMP_NATION" name="EMP_NATION" required
                                            value="{{ $DATA_EMP->EMP_NATION }}">
                                    </div>

                                </div>
                                <div class="row has-error">
                                    <div class="col-md-6">
                                        <label>ตำแหน่ง ***</label>
                                        <select class="form-control" id="EMP_RANK_UNID" name="EMP_RANK_UNID">
                                            @foreach ($DATA_RANK as $index => $row)
                                                <option value="{{ $row->UNID }}"
                                                    {{ $DATA_EMP->EMP_RANK_UNID == $row->UINID ? 'selected' : '' }}>
                                                    {{ $row->RANK_NAME_TH }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>วันที่เข้าทำงาน</label>
                                        <input type="date" class="form-control" id="EMP_IN_DATE" name="EMP_IN_DATE"
                                            value="{{ date('Y-m-d',strtotime($DATA_EMP->EMP_IN_YEAR . '/' . $DATA_EMP->EMP_IN_MONTH . '/' . $DATA_EMP->EMP_IN_DAY)) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success float-right text-byme">
                                    <i class="fas fa-save mr-1"></i>บันทึก
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection
@section('java')
    <script>
        $('#FILE_IMG').change(function() {
            var id = 'IMG_SHOW';
            readURL(this, id);
            $('#' + id).css({
                'width': '285',
                'height': '285'
            });
        })

        function readURL(input, id_img) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + id_img).attr('src', e.target.result);

                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

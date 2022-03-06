@extends('masteredit.master')
@section('content')
    <style>
        .text-byme {
            font-size: 16px;
        }

        .btn-status {
            font-size: 0.1rem;
            display: inline-block;
            vertical-align: top;
        }

        .btn-status__input {
            display: none;
        }

        .btn-status__button {
            position: relative;
            display: inline-block;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;

            width: 100px;
            height: 45px;
            background: #f25961;
            color: rgb(255, 255, 255);
            border: solid 1px #f25961;
            border-radius: 7px;
            transition: all 0.3s ease;
            cursor: pointer;
            padding: 0.65rem 1.4rem;
            font-size: 14px;
            opacity: 1;

        }

        .btn-status__button::before {
            position: absolute;
            width: 15px;
            top: 12px;
            left: 13px;
            display: inline-block;
            width: 20px;
            height: 20px;
            background: #FFF;
            border-radius: 100%;
            transition: all 0.3s ease;
        }

        .btn-status__button::after {
            content: "ปิด";
            position: absolute;
            top: 10px;
            left: 45px;
            font-size: 1rem;
        }

        .btn-status__button--correct {
            position: absolute;
            width: 25px;
            top: 10px;
            left: 15px;
            visibility: hidden;
        }


        .btn-status__input:checked+.btn-status__button {
            background: #31ce36;
            border: #31ce36;
            color: white;
        }

        .btn-status__input:checked+.btn-status__button>.btn-status__button--correct {
            visibility: visible;
        }

        .btn-status__input+.btn-status__button>.btn-status__button--correct {
            visibility: visible;
        }

        .btn-status__input:checked+.btn-status__button::after {
            content: "เปิด";
        }

    </style>
    <div class="content">
        <div class="page-inner py-3">
            <div class="card">
                <div class="card-header bg-purple text-white">
                    <div class="row">
                        <div class="col-md-12 form-inline">
                            <h1>ป้ายแสดงกลุ่มข้อมูล</h1>
                            <button type="button" class="btn btn-warning ml-auto" onclick="show_tag()">
                                <i class="fa fa-plus text-byme">
                                    เพิ่ม Tag
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info ">
                                <thead>
                                    <tr>
                                        <th width="3%">
                                            <h3>ลำดับ</h3>
                                        </th>
                                        <th width="53%">
                                            <h3>ชื่อป้าย(Tag)</h3>
                                        </th>
                                        <th width="15%">
                                            <h3>สถานะ</h3>
                                        </th>
                                        <th width="32%">
                                            <h3>Action</h3>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($DATA_TAG as $index => $row)
                                        @php
                                            $list_number = $DATA_TAG->firstItem() + $index;
                                            $status = $row->TAG_STATUS;
                                            $status_check = $status == 'OPEN' ? 'checked' : '';
                                            $img_check = $status == 'OPEN' ? 'correct.png' : 'incorrect.png';
                                        @endphp
                                        <tr>
                                            <td class="text-center">
                                                <h3>{{ $list_number }}</h3>
                                            </td>
                                            <td>
                                                <h3>{{ $row->TAG_NAME }}</h3>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12 form-inline">
                                                        <section>
                                                            <label for="btn-status" class="btn-status">
                                                                <input type="checkbox"
                                                                    id="check-status_{{ $list_number }}"
                                                                    class="btn-status__input" {{ $status_check }}>
                                                                <span class="btn-status__button"
                                                                    data-unid="{{ $row->UNID }}"
                                                                    data-id_number="{{ $list_number }}"
                                                                    onclick="change_status(this)">
                                                                    <img src="{{ asset('assets/image/common/' . $img_check) }}"
                                                                        id="btn-status_{{ $list_number }}"
                                                                        class="btn-status__button--correct">
                                                                </span>
                                                            </label>
                                                        </section>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12 form-inline">
                                                        <button type="button" class="btn btn-success ml-auto mr-auto"
                                                            data-unid="{{ $row->UNID }}" onclick="show_tag(this)">
                                                            <i class="fas fa-edit mx-2"></i>
                                                            แก้ไข
                                                        </button>
                                                        <a href="{{ route('edit.tag.remove') . '?UNID=' . $row->UNID }}"
                                                            class="btn btn-danger ml-auto mr-auto">
                                                            <i class="fas fa-trash mx-2"></i>
                                                            ลบ
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-purple text-white">
                    <div class="row">
                        <div class="col-md-12 form-inline">
                            <h1>ผู้ใช้งานระบบ</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info ">
                                <thead>
                                    <tr>
                                        <th width="3%">
                                            <h3>ลำดับ</h3>
                                        </th>
                                        <th width="45%">
                                            <h3>ชื่อผู้ใช้</h3>
                                        </th>
                                        <th width="45%">
                                            <h3>อีเมล</h3>
                                        </th>
                                        <th width="20%">
                                            <h3>Action</h3>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($DATA_USER as $index_user => $row_user)
                                        @php
                                            $list_number = $DATA_USER->firstItem() + $index_user;
                                            $status = $row_user->TAG_STATUS;
                                            $status_check = $status == 'OPEN' ? 'checked' : '';
                                            $img_check = $status == 'OPEN' ? 'correct.png' : 'incorrect.png';
                                        @endphp
                                        <tr>
                                            <td class="text-center">
                                                <h3>{{ $list_number }}</h3>
                                            </td>
                                            <td>
                                                <h3>{{ $row_user->USERNAME }}</h3>
                                            </td>
                                            <td>
                                                <h3>{{ $row_user->EMAIL }}</h3>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12 form-inline">
                                                        <button type="button" class="btn btn-success ml-auto mr-auto"
                                                            data-unid="{{ $row_user->UNID }}"
                                                            data-role="{{ $row_user->ROLE }}" onclick="show_user(this)">
                                                            <i class="fas fa-edit mx-2"></i>

                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="show_tag" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <form action="{{ route('edit.tag.save') }}" method="post" id="FRM_TAG">
                @csrf
                <input type="hidden" id="TAG_UNID" name="TAG_UNID">
                <div class="modal-content">
                    <div class="modal-header bg-purple text-white">
                        <h2 class="modal-title" id="title_tag"></h2>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size:25px">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center" id="head_tag">
                                <h3>เพิ่มชื่อกลุ่ม</h3>
                            </div>
                            <div class="col-md-12 my-2">
                                <label id="label_tag">กรุณากรอกชื่อกลุ่ม</label>
                                <input type="text" class="form-control my-2" id="TAG_NAME" name="TAG_NAME"
                                    placeholder="กรุณาระบุชื่อ กลุ่ม เช่น ประชาสัมพันธ์ หรือ แรงงาน" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-byme" data-dismiss="modal">
                            <i class="fa fa-times mx-1 "></i>
                            ยกเลิก
                        </button>
                        <button type="submit" class="btn btn-success text-byme" id="btn_tag">
                            <i class="fas fa-save mx-1 "></i>
                            เพิ่ม
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="show_user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <form action="{{ route('user.update') }}" method="post" id="FRM_REGISTER">
                @csrf
                <input type="hidden" id="UNID_USER" name="UNID_USER">
                <div class="modal-content">
                    <div class="modal-header bg-purple text-white">
                        <h2 class="modal-title" id="title_tag">แก้ไขสมาชิก</h2>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size:25px">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center" id="head_tag">
                                <h3>แก้ไขสมาชิก</h3>
                            </div>
                            <div class="col-md-6 my-2  has-error">
                                <label id="label_tag">รหัสผ่าน</label>
                                <input type="password" class="form-control my-2" id="PASSWORD" name="PASSWORD">
                            </div>
                            <div class="col-md-6 my-2  has-error">
                                <label id="label_tag">ระดับการแก้ไข</label>
                                <select class="form-control my-2" id="ROLE" name="ROLE">
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="USER">USER</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-byme" data-dismiss="modal">
                            <i class="fa fa-times mx-1 "></i>
                            ยกเลิก
                        </button>
                        <button type="submit" class="btn btn-success text-byme">
                            <i class="fas fa-edit mx-1 "></i>
                            แก้ไข
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('java')
    <script>
        function show_tag(thisdata) {
            var unid = $(thisdata).data('unid');
            var title_tag = unid == null ? 'เพิ่มกลุ่ม(Tag)' : 'แก้ชื่อกลุ่ม(Tag)';
            var label_tag = unid == null ? 'กรุณากรอกชื่อกลุ่ม' : 'ชื่อกลุ่มที่กำลังแก้';
            $('#title_tag').html(title_tag);
            $('#head_tag').html(title_tag);
            $('#label_tag').html(label_tag);

            var url = "{{ route('edit.tag.show') }}";
            if (unid != null) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        UNID: unid
                    },
                    success: function(response) {
                        $('#FRM_TAG').attr('action', "{{ route('edit.tag.edit') }}");
                        $('#btn_tag').html('<i class="fas fa-edit mx-1 "></i>แก้ไข');
                        $("#TAG_UNID").val(unid);
                        $('#TAG_NAME').val(response.TAG_NAME);
                    }
                });
            } else {
                $('#FRM_TAG').attr('action', "{{ route('edit.tag.save') }}");
                $('#TAG_NAME').val('');
                $('#TAG_UNID').val('');
                $('#btn_tag').html('<i class="fas fa-save mx-1 "></i>เพิ่ม');
            }

            $('#show_tag').modal('show');
        }

        function change_status(thisdata) {
            var id_btn = $(thisdata).data('id_number');
            var unid = $(thisdata).data('unid');
            var src = "{{ asset('assets/image/common/') }}";
            var url = "{{ route('edit.tag.status') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    UNID: unid
                },
                success: function(response) {
                    if (response.status == 'OPEN') {
                        $('#btn-status_' + id_btn).attr('src', src + '/correct.png');
                        $('#check-status_' + id_btn).prop('checked', true);
                    } else {
                        $('#btn-status_' + id_btn).attr('src', src + '/incorrect.png');
                        $('#check-status_' + id_btn).prop('checked', false);
                    }
                }
            });
        }

        function show_user(thisdata) {
            var unid = $(thisdata).data('unid');
            var role = $(thisdata).data('role');
            $('#UNID_USER').val(unid);
            $('#ROLE').val(role);
            $('#show_user').modal('show');
        }
    </script>
@endsection

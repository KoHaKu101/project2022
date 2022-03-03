@extends("masteredit.master")
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/edithome.css') }}">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="content">
        <div class="page-inner py-3">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-purple text-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-inline">
                                        <h1>ตำแหน่ง</h1>
                                        <button class="btn btn-warning ml-auto" onclick="modal_rank()">
                                            <i class="fas fa-plus mr-1"></i>เพิ่มตำแหน่ง
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($DATA_RANK as $index_rank => $row_rank)
                                    <div class="col-md-12 form-inline mb-2">
                                        <button type="button"
                                            class="btn btn-primary">{{ $row_rank->RANK_NAME_TH }}</button>
                                        <button type="button" class="btn btn-warning ml-auto"
                                            data-unid="{{ $row_rank->UNID }}"
                                            data-name_th="{{ $row_rank->RANK_NAME_TH }}"
                                            data-name_en="{{ $row_rank->RANK_NAME_ENG }}" onclick="edit_rank(this)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger ml-1"
                                            data-unid="{{ $row_rank->UNID }}" data-name="{{ $row_rank->RANK_NAME_TH }}"
                                            onclick="remove_rank(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header bg-purple text-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-inline">
                                        <h1>พนักงาน</h1>
                                        <a href="{{ route('empschool.show') }}" class="btn btn-warning ml-auto">
                                            <i class="fas fa-plus mr-1"></i>เพิ่มพนักงาน
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-bordered table-head-bg-info table-bordered-bd-info ">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="28%">ชื่อ</th>
                                            <th width="28%">นามสกุล</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($DATA_EMP as $index_emp => $row_emp)
                                            <tr>
                                                <td>{{ $index_emp + 1 }}</td>
                                                <td>{{ $row_emp->EMP_FIRST_NAME_TH }}</td>
                                                <td>{{ $row_emp->EMP_LAST_NAME_TH }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12 form-inline ">
                                                            <button type="button" class="btn btn-warning ml-auto mr-auto">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger ml-ato mr-auto">
                                                                <i class="fas fa-trash"></i>
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
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_rank" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <form action="{{ route('emprank.insert') }}" method="post" id="FRM_EMP_RANK">
                    @csrf
                    <input type="hidden" id="UNID" name="UNID">
                    <div class="modal-header bg-purple text-white">
                        <h3 class="modal-title">ตำแหน่ง</h3>
                        <button type="button" class="close text-white " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3>ตำแหน่ง</h3>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <label>ตำแหน่งภาษาอังกฤษ</label>
                                <input type="text" class="form-control" id="RANK_NAME_ENG" name="RANK_NAME_ENG" required>
                            </div>
                            <div class="col-md-6">
                                <label>ตำแหน่งภาษาไทย</label>
                                <input type="text" class="form-control" id="RANK_NAME_TH" name="RANK_NAME_TH" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa fa-times mr-2"></i>ยกเลิก</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus mr-2"></i>เพิ่ม</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('java')
    <script>
        function modal_rank() {
            var route = "{{ route('emprank.insert') }}";
            $('#FRM_EMP_RANK').attr('action', route);
            $('#UNID').val();
            $('#RANK_NAME_ENG').val();
            $('#RANK_NAME_TH').val();
            $('#modal_rank').modal('show');
        }

        function edit_rank(thisdata) {
            var unid = $(thisdata).data('unid');
            var name_th = $(thisdata).data('name_th');
            var name_en = $(thisdata).data('name_en');
            var route = "{{ route('emprank.update') }}";
            $('#UNID').val(unid);
            $('#RANK_NAME_ENG').val(name_en);
            $('#RANK_NAME_TH').val(name_th);
            $('#FRM_EMP_RANK').attr('action', route);
            $('#modal_rank').modal('show');

        }

        function remove_rank(thisdata) {
            var name = $(thisdata).data('name');
            Swal.fire({
                icon: 'warning',
                title: 'ต้อการลบ ' + name + ' มั้ย',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: 'ลบ',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#31ce36',
                cancelButtonColor: '#f25961',
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('emprank.delete') }}";
                    var unid = $(thisdata).data('unid');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            UNID: unid
                        },
                        success: function(response) {
                            if (response.status == 'pass') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลบรายการสำเร็จ',
                                    timer: '1500',
                                }).then(function() {
                                    location.reload();
                                })
                            }

                        }
                    });
                }
            })
        }
    </script>
@endsection

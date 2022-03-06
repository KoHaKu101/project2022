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
                                <h1>ข้อมูลพื้นฐานโรงเรียน</h1>
                                <button class="btn btn-warning ml-auto" onclick="first_school()">เพิ่มข้อมูลโรงเรียน</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                                    <thead>
                                        <tr>
                                            <th width="5%">ลำดับ</th>
                                            <th width="40%">ชื่อข้อมูลพื้นฐานโรงเรียน</th>
                                            <th width="">เนื้อหาข้อมูลเพิ่มเติ</th>
                                            <th width="20%">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <style>
                                            td.description {
                                                vertical-align: top;
                                            }

                                        </style>
                                        @foreach ($DATA_DETAIL_ID as $index => $row)
                                            <tr>
                                                <td>{{ $DATA_DETAIL_ID->firstitem() }}</td>
                                                <td>
                                                    <a href="{{ route('edit.school.show', ['UNID' => $row->UNID]) }}"
                                                        class="btn btn-primary btn-block text-left">
                                                        <h3><i class="fas fa-eye mr-3"></i>{{ $row->DETAIL_HEAD }}</h3>
                                                    </a>
                                                </td>
                                                <td>
                                                    @foreach ($DATA_DETAIL->where('UNID_REF', '=', $row->UNID) as $sub_index => $sub_row)
                                                        <a href="#"
                                                            class="btn btn-secondary btn-block text-left btn-sm my-1 text-center">
                                                            <h3>
                                                                {{ $sub_row->DETAIL_HEAD }}
                                                            </h3>
                                                        </a>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning mx-1"
                                                        onclick="edit_detail(this)" data-unid="{{ $row->UNID }}"
                                                        data-head="{{ $row->DETAIL_HEAD }}"
                                                        data-type="{{ $row->DETAIL_TYPE }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger mx-1"
                                                        onclick="delete_detail(this)" data-unid="{{ $row->UNID }}"
                                                        data-head="{{ $row->DETAIL_HEAD }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $DATA_DETAIL_ID->links('paginator.default') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="first_school" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('edit.school.insert') }}" method="post" id="FRM_INSERT">
                    @csrf
                    <input type="hidden" id="UNID" name="UNID" value="">
                    <div class="modal-header bg-purple text-white">
                        <h3 class="modal-title">เพิ่มข้อมูลพื้นฐานโรงเรียน</h3>
                        <button type="button" class="close text-white " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3>ข้อมูลพื้นฐานโรงเรียน</h3>
                            </div>

                        </div>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <label>ชื่อหัวข้อภาษาอังกฤษ</label>
                                <input type="text" class="form-control" id="DETAIL_TYPE" name="DETAIL_TYPE"
                                    placeholder="กรุณากรอกชื่อหัวข้อเป็นภาษาอังกฤษ เช่น visionandmission" required>
                            </div>
                            <div class="col-md-6">
                                <label>ชื่อหัวข้อภาษาไทย</label>
                                <input type="text" class="form-control" id="DETAIL_HEAD" name="DETAIL_HEAD"
                                    placeholder="กรุณากรอกชื่อหัวข้อเป็นภาษาไทย เช่น วิสัยทัศน์และพันธกิจ" required>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12 text-center">
                                <h2>*****ข้อมูลจะต้องเพิ่มหลังจากทำข้างต้นเสร็จเท่านั้น*****</h2>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-times mr-2"></i>ยกเลิก
                        </button>
                        <button type="submit" class="btn btn-success" id="BTM_SUBMIT">
                            <i class="fa fa-plus mr-2"></i>เพิ่ม
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('java')
    <script>
        function first_school() {
            var html = '<i class="fas fa-plus mr-2"></i>เพิ่ม';
            var url = "{{ route('edit.school.insert') }}";
            $('#FRM_INSERT').attr('action', url);
            $('#UNID').val();
            $('#BTM_SUBMIT').html(html);
            $('#first_school').modal('show');
        }

        function edit_detail(thisdata) {
            var unid = $(thisdata).data('unid');
            var head = $(thisdata).data('head');
            var type = $(thisdata).data('type');
            var url = "{{ route('edit.school.update') }}"
            var html = '<i class="fas fa-save mr-2"></i>แก้ไข';
            $('#FRM_INSERT').attr('action', url);
            $('#BTM_SUBMIT').html(html);
            $('#UNID').val(unid);
            $('#DETAIL_TYPE').val(type);
            $('#DETAIL_HEAD').val(head);
            $('#first_school').modal('show');
        }

        function delete_detail(thisdata) {
            var unid = $(thisdata).data('unid');
            var head = $(thisdata).data('head');
            Swal.fire({
                icon: 'warning',
                title: 'ต้องการลบ : ' + head + ' มั้ย',
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: 'ยกเลิก',
                confirmButtonText: 'ตกลง',
                cancelButtonColor: '#dc3545',
                confirmButtonColor: '#31ce36',
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('edit.school.delete') }}";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            UNID: unid
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: response.icon,
                                title: response.title,
                                text: response.text,
                                timer: '2000',
                            }).then(function(response) {
                                location.reload();
                            })
                        }
                    });
                }
            })
        }
        $('#first_school').on('hidden.bs.modal', function() {
            $('#FRM_INSERT')[0].reset();
        });
    </script>
@endsection

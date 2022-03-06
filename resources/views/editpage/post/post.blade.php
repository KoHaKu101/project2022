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

    </style>
    <div class="content">
        <div class="page-inner py-3">
            <div class="card">
                <div class="card-header bg-purple text-white">
                    <div class="row">
                        <div class="col-md-12 form-inline">
                            <h1><i class="fas fa-newspaper mr-2"></i>ข่าวสาร</h1>
                            <button type="button" class="btn btn-warning ml-auto" onclick="modal_post(this)"
                                data-name="เพิ่มข่าวสาร">
                                <i class="fa fa-plus text-byme">
                                    เพิ่ม ข่าวสาร
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
                                        <th width="5%">
                                            <h3>ลำดับ</h3>
                                        </th>
                                        <th width="53%">
                                            <h3>หัวข้อข่าวสาร</h3>
                                        </th>
                                        <th width="15%">
                                            <h3>ประเภท</h3>
                                        </th>
                                        <th width="22%">
                                            <h3>Action</h3>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($DATA_POST as $index => $row)
                                        <tr>
                                            <td class="text-center">
                                                <h3>{{ $index + 1 }}</h3>
                                            </td>
                                            <td>
                                                <h3>{{ $row->POST_HEADER }}</h3>
                                            </td>
                                            <td>
                                                @if ($row->POST_TYPE == 'DEFAULT')
                                                    <button class="btn btn-secondary btn-block dis">
                                                        <i class="fas fa-book mr-1"></i> แบบข้อความ และรูปภาพ
                                                    </button>
                                                @elseif($row->POST_TYPE == 'PDF')
                                                    <button class="btn btn-danger btn-block dis">
                                                        <i class="fas fa-file-pdf mr-1"></i> แบบไฟล์ PDF
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('post.show.edit', ['UNID' => $row->UNID]) }}"
                                                    class="btn btn-warning mx-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger mx-1"
                                                    onclick="delete_post(this)" data-unid="{{ $row->UNID }}"
                                                    data-name="{{ $row->POST_HEADER }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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
    @include('editpage.modalhome.post')
@endsection
@section('java')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    @include('editpage.javamixphp.post')
    <script>
        function delete_post(thisdata) {
            var unid = $(thisdata).data('unid');
            var name = $(thisdata).data('name');
            Swal.fire({
                icon: 'warning',
                title: 'ต้องการลบ ' + name + ' มั้ย ?',
                showConfirmButton: true,
                showCancelButton: true,
                cancelButtonText: 'ยกเลิก',
                confirmButtonText: 'ตกลง',
                confirmButtoncolor: '#dc3545',
                cancelButtoncolor: '#31ce36',
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('post.delete') }}";
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
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection

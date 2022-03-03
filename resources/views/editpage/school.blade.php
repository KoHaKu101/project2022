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
                        @foreach ($DATA_DETAIL_ID as $index => $row)
                            <div class="col-md-4">
                                <a href="{{ route('edit.school.show', ['UNID' => $row->UNID]) }}"
                                    class="btn btn-primary btn-block">
                                    <h3>{{ $row->DETAIL_HEAD }}</h3>
                                </a>
                            </div>
                        @endforeach

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
                <form action="{{ route('edit.school.insert') }}" method="post">
                    @csrf

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
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa fa-times mr-2"></i>ยกเลิก</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('java')
    <script>
        function first_school() {
            $('#first_school').modal('show');
        }
    </script>
@endsection

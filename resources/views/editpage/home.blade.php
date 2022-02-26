@extends("masteredit.master")
@section('content')
    <div class="content">
        <div class="page-inner py-3">
            <div class="card">
                <div class="card-header bg-purple text-white">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-inline">
                                <h1>ภาพสไลด์ ทั้งหมด {{ $LIMIT_NUMBER }} </h1>
                                <button class="btn btn-warning ml-auto" onclick="addnumber_slide()">เพิ่มจำนวนสไลด์</button>
                            </div>
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
                                                    class="btn btn-warning btn-sm text-center btn-self btn-block my-2"
                                                    onclick="modalslide(this)" data-number="{{ $i }}">
                                                    แก้ไข
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm text-center btn-self btn-block my-2"
                                                    onclick="delete_slide_img(this)" data-number="{{ $i }}">
                                                    ลบรูป
                                                </button>
                                            </div>
                                        @else
                                            <div class="col-md-12">
                                                <button type="button"
                                                    class="btn btn-warning btn-sm text-center btn-self btn-block my-2"
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
                                    <img src="{{ asset('assets/image/people/' . $DIRECTOR_IMG) }}" id="SHOW_DIRECTOR"
                                        style="height:299px;width:243px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('director.upload') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-inline">
                                            <input type="file" class="form-control form-control-sm " id="DIRECTOR_IMG"
                                                name="DIRECTOR_IMG" required>
                                            <button type="submit" class="btn btn-success btn-sm my-2 ml-auto text-byme">
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
                                <div class="col-md-12">
                                    <div class="form-inline">
                                        <h1 class="text-white">สาส์นจากผู้อำนวยการ</h1>
                                        <button type="button" class="btn btn-warning btn-sm text-byme ml-auto"
                                            onclick="director()" {{ session('FOCUS') == 'DIRECTOR' ? 'autofocus' : '' }}>
                                            แก้ไขข้อความ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class=" row">
                                <div class="col-md-12">
                                    <h3 class="indent" id="DIRECTOR_TEXT">
                                        {{ isset($DATA_DIRCETOR->DIRCETOR_TEXT) ? $DATA_DIRCETOR->DIRCETOR_TEXT : '' }}
                                    </h3>
                                    <br>
                                    <br>
                                    <h1 class="text-center text-primary" id="DIRECTOR_NAME">
                                        {{ isset($DATA_DIRCETOR->DIRCETOR_TEXT_NAME) ? $DATA_DIRCETOR->DIRCETOR_TEXT_NAME : '' }}
                                    </h1>
                                    <h1 class="text-center text-primary" id="DIRECTOR_SCHOOL">
                                        {{ isset($DATA_DIRCETOR->DIRCETOR_SCHOOL) ? $DATA_DIRCETOR->DIRCETOR_SCHOOL : '' }}
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
                                <div class="col-md-12 text-white">
                                    <div class="form-inline">
                                        <h1>เกี่ยวกับโรงเรียน</h1>
                                        <button type="button" class="btn btn-warning text-byme ml-auto"
                                            onclick="modal_about(this)" data-name="เพิ่มข้อมูล"
                                            {{ session('FOCUS') == 'ABOUT_SCHOOL' ? 'autofocus' : '' }}>
                                            <i class="fas fa-plus"></i>
                                            เพิ่มข้อมูล
                                        </button>
                                    </div>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-purple">
                            <div class="row ">
                                <div class=" col-md-12 text-white">
                                    <div class="form-inline">
                                        <h1>ข่าวสาร</h1>
                                        <div class="form-group">
                                            <h1 class="mr-2"> ประจำเดือน :</h1>
                                            <select class="form-control text-byme " style="padding: 0.1rem 1rem"
                                                id="SELECT_MONTH_POST" name="SELECT_MONTH_POST">
                                                @php
                                                    $months_full_th = ['0' => 'ทั้งหมด', '1' => 'มกราคม', '2' => 'กุมภาพันธ์', '3' => 'มีนาคม', '4' => 'เมษายน', '5' => 'พฤษภาคม', '6' => 'มิถุนายน', '7' => 'กรกฎาคม', '8' => 'สิงหาคม', '9' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'];
                                                @endphp
                                                @for ($n_month = 0; $n_month <= 12; $n_month++)
                                                    <option value="{{ $n_month }}"
                                                        {{ $n_month == $POST_MONTH ? 'selected' : '' }}>
                                                        {{ $months_full_th[$n_month] }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group  mr-auto">
                                            <h1 class="mr-2"> ประเภทข้อมูล : </h1>
                                            <select class="form-control text-byme " style="padding: 0.1rem 1rem"
                                                id="SELECT_TYPE_POST" name="SELECT_TYPE_POST"
                                                {{ $FOCUS == 'PDF' || $FOCUS == 'DEFAULT' ? 'autofocus' : '' }}>
                                                <option value="DEFAULT" {{ $POST_TYPE == 'DEFAULT' ? 'selected' : '' }}>
                                                    ข้อมูลทั่วไป
                                                </option>
                                                <option value="PDF" {{ $POST_TYPE == 'PDF' ? 'selected' : '' }}>
                                                    ข้อมูลPDF
                                                </option>

                                            </select>
                                        </div>
                                        <div class="form-group  ml-auto">
                                            <button type="button" class="btn btn-warning text-byme"
                                                onclick="modal_post(this)" data-name="เพิ่มข่าวสาร">
                                                <i class="fas fa-plus"></i>
                                                เพิ่มข่าวสาร
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row" id="SHOW_POST">
                                        @foreach ($DATA_POST as $index_post => $row_post)
                                            <div class="col-sm-6 col-md-4">
                                                <div class="card card-stats card-info card-round">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="icon-big text-center">
                                                                    <img src="{{ asset('assets/image/post/logo/' . $row_post->POST_IMG_LOGO . $row_post->POST_IMG_EXT) }}"
                                                                        style="width: 100px ">
                                                                </div>
                                                            </div>
                                                            <div class="col-8 col-stats">
                                                                <div class="numbers text-center">
                                                                    <p class="card-title">
                                                                        {{ $row_post->POST_HEADER }}</p>
                                                                    <p class="card-title">
                                                                        {{ $row_post->POST_DAY . '/' . $row_post->POST_MONTH . '/' . $row_post->POST_YEAR }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row my-2">
                                                            <div class="col-md-12">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-block btn-sm text-byme">
                                                                    <i class="fas fa-edit"></i> แก้ไข
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="border-top: 2px solid !important;">
                            <div class="row">
                                <div class="col-md-12" id="PAGINATOR_POST">
                                    {{ $DATA_POST->links('paginator.default') }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-purple text-white">
                            <h1>ติดต่อ</h1>
                        </div>
                        @php
                            $CONTRACT_MAP = $DATA_CONTRACT->where('CONTRACT_TYPE', '=', 'MAP')->first();
                            $locationmap = isset($CONTRACT_MAP->CONTRACT_DATA) ? $CONTRACT_MAP->CONTRACT_DATA : '';
                            $CONTRACT_EMAIL = $DATA_CONTRACT->where('CONTRACT_TYPE', '=', 'EMAIL');
                            $CONTRACT_TEL = $DATA_CONTRACT->where('CONTRACT_TYPE', '=', 'TEL');
                        @endphp
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12" id="MAP">
                                                    <h3>แผนที่</h3>
                                                    <iframe width=" 100%" height="300"
                                                        src="https://maps.google.com/maps?q={{ $locationmap }}&t=&z=17&ie=UTF8&iwloc=&output=embed"
                                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                                    </iframe>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <form action="{{ route('contract.insert.map') }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-inline">
                                                            <input type="text"
                                                                class="form-control form-control-sm col-md-11"
                                                                id="CONTRACT_MAP" name="CONTRACT_MAP"
                                                                placeholder="กรุณาระบุตำแหน่งแผนที" required
                                                                {{ session('FOCUS') == 'MAP' ? 'autofocus' : '' }}>
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm my-2 ml-auto text-byme">
                                                                บันทึก</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <h1>อีเมล์(Email)</h1>
                                                    <form action="{{ route('contract.insert.data') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" id="CONTRACT_TYPE" name="CONTRACT_TYPE"
                                                            value="EMAIL">
                                                        <div class="row ">
                                                            <div class="col-md-12 form-inline">
                                                                <input type="text" class="form-control col-md-9 "
                                                                    id="CONTRACT_DATA" name="CONTRACT_DATA"
                                                                    placeholder="กรุณาระบุอีเมล" required
                                                                    {{ session('FOCUS') == 'EMAIL' ? 'autofocus' : '' }}>
                                                                <button type="submit"
                                                                    class="btn btn-success text-byme ml-auto"><i
                                                                        class="fas fa-plus mr-2"></i>เพิ่ม</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive my-2">
                                                        <table
                                                            class="table table-bordered table-head-bg-info table-bordered-bd-info ">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" style="width: 60%">Email</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($CONTRACT_EMAIL as $index_email => $row_email)
                                                                    <tr>
                                                                        <td>
                                                                            <h4>{{ $row_email->CONTRACT_DATA }}</h4>
                                                                        </td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <button type="button"
                                                                                    class="btn btn-warning mx-1"
                                                                                    data-unid="{{ $row_email->UNID }}"
                                                                                    data-name="{{ $row_email->CONTRACT_DATA }}"
                                                                                    data-type="{{ $row_email->CONTRACT_TYPE }}"
                                                                                    onclick="edit_contract(this)">
                                                                                    <i class="fas fa-edit"></i>
                                                                                </button>
                                                                                <button type="button"
                                                                                    class="btn btn-danger mx-1"
                                                                                    data-unid='{{ $row_email->UNID }}'
                                                                                    onclick="remove_contract(this)">
                                                                                    <i class="fas fa-trash"></i>
                                                                                </button>
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
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h1>เบอร์โทร</h1>
                                                    <form action="{{ route('contract.insert.data') }}" method="post">
                                                        <div class="row ">
                                                            @csrf
                                                            <input type="hidden" id="CONTRACT_TYPE" name="CONTRACT_TYPE"
                                                                value="TEL">
                                                            <div class="col-md-12 form-inline">
                                                                <input type="number" class="form-control col-md-9 "
                                                                    id="CONTRACT_DATA" name="CONTRACT_DATA"
                                                                    placeholder="กรุณาระบุเบอร์โทรที่ติดต่อได้" required
                                                                    {{ session('FOCUS') == 'TEL' ? 'autofocus' : '' }}>
                                                                <button type="submit"
                                                                    class="btn btn-success text-byme ml-auto"><i
                                                                        class="fas fa-plus mr-2"></i>เพิ่ม</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive my-2">
                                                        <table
                                                            class="table table-bordered table-head-bg-info table-bordered-bd-info ">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" style="width: 60%">Email</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                                @foreach ($CONTRACT_TEL as $index_tel => $row_tel)
                                                                    <tr>
                                                                        <td>
                                                                            <h4>{{ $row_tel->CONTRACT_DATA }}</h4>
                                                                        </td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <button type="button"
                                                                                    class="btn btn-warning mx-1"
                                                                                    data-unid="{{ $row_tel->UNID }}"
                                                                                    data-name="{{ $row_tel->CONTRACT_DATA }}"
                                                                                    data-type="{{ $row_tel->CONTRACT_TYPE }}"
                                                                                    onclick="edit_contract(this)">
                                                                                    <i class="fas fa-edit"></i>
                                                                                </button>
                                                                                <button type="button"
                                                                                    class="btn btn-danger mx-1"
                                                                                    data-unid='{{ $row_tel->UNID }}'
                                                                                    data-type="{{ $row_tel->CONTRACT_TYPE }}"
                                                                                    onclick="remove_contract(this)">
                                                                                    <i class="fas fa-trash"></i>
                                                                                </button>
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
    @include('editpage.modalhome.about')
    @include('editpage.modalhome.post')
    <!-- Button trigger modal -->
@endsection
@section('java')
    <script src="{{ asset('assets/js/edit/home/director.js') }}"></script>
    <script src="{{ asset('assets/js/edit/home/imgshow.js') }}"></script>

    @include('editpage.javamixphp.about')
    @include('editpage.javamixphp.slide')
    @include('editpage.javamixphp.post')

    <script>
        function edit_contract(thisdata) {
            var unid = $(thisdata).data('unid');
            var name = $(thisdata).data('name');
            var type = $(thisdata).data('type');
            var input = type == 'EMAIL' ? 'text' : 'number';
            Swal.fire({
                text: 'ใส่จะนวนสไลด์ที่ต้องการ',
                inputLabel: "Email ที่กำลังแก้ไข : " + name,
                input: input,
            }).then(function(result) {
                if (result.value) {
                    var url = "{{ route('contract.insert.data') }}?CONTRACT_TYPE=" + type + "&CONTRACT_UNID=" +
                        unid + "&CONTRACT_DATA=" + result.value;
                    $.ajax({
                        type: "POST",
                        url: url,
                        success: function(response) {
                            Swal.fire({
                                icon: response.icon,
                                title: response.title,
                                timer: 1000,
                            }).then(function() {
                                location.reload();
                            });

                        }
                    });

                }
            })
        }

        function remove_contract(thisdata) {
            var unid = $(thisdata).data('unid');
            var type = $(thisdata).data('type');
            var url = "{{ route('contract.delete.data') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    CONTRACT_UNID: unid,
                    CONTRACT_TYPE: type,
                },
                success: function(response) {
                    Swal.fire({
                        icon: response.icon,
                        title: response.title,
                        timer: 1000,
                    }).then(function() {
                        location.reload();
                    });


                }
            });
        }
    </script>
@endsection

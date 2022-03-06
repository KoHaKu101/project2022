@extends("master.master")
@section('body')
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('homepage') }}">หน้าแรก</a></li>
                    <li><a href="#">บุคลากร</a></li>
                    <li>ทั้งหมด</li>
                </ol>
                <h2>บุคลากร ทั้งหมด
                    {{ isset($RANK_NAME_TH) ? 'ตำแหน่ง : ' . $RANK_NAME_TH : '' }}
                </h2>

            </div>
        </section>
        <section id="blog" class="blog">
            <div class="container aos-init aos-animate" data-aos="fade-up">
                <div class="row">
                    <div class="form-group col-md-3 ">
                        <label>เลือกตำแหน่ง</label>
                        <select class="form-control" id="RANK_SELECT">
                            <option value="">ทั้งหมด</option>
                            @foreach ($DATA_RANK as $index_rank => $row_rank)
                                <option value="{{ $row_rank->RANK_NAME_ENG }}"
                                    {{ $RANK_NAME_ENG == $row_rank->RANK_NAME_ENG ? ' selected' : '' }}>

                                    {{ $row_rank->RANK_NAME_TH }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4 ms-auto">
                        <label>ค้นหา</label>
                        <div class="input-group mb-3 ">
                            <input type="text" class="form-control me-auto" id="SEACH_EMP" value="{{ $SEARCH_EMP }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" onclick="search_emp()" id="BTN_SEARCH">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4" id="TABLE_EMPLOYEE">
                        <thead>
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th width="17%">รูป</th>
                                <th width="">ชื่อ นามสกุล</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($DATA_EMP as $index => $row)
                                @php
                                    $img = isset($row->EMP_IMG) ? $row->EMP_IMG . $row->EMP_IMG_EXT : 'noimg.jpg';
                                @endphp
                                <tr>
                                    <td class="text-center">
                                        <h4>{{ $DATA_EMP->firstItem() }}</h4>
                                    </td>
                                    <td>
                                        <img src="{{ asset('assets/image/emp/' . $img) }}" class="img-fluid"
                                            style="max-width:177px;max-height:177px">
                                    </td>
                                    <td>
                                        <h4>
                                            {{ $row->EMP_PREFIX . ' : ' . $row->EMP_FIRST_NAME_TH . ' ' . $row->EMP_LAST_NAME_TH }}
                                            <br>
                                            {{ 'อายุ : ' . $row->EMP_AGE . ' ปี ' }}
                                            <br>
                                            {{ 'ตำแหน่ง : ' . $row->EMP_RANK }}
                                            <br>
                                            {{ 'สอนอยู่ที่ : ศูนย์พัฒนาเด็กเล็กบ้านหนองคูโคก' }}

                                        </h4>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $DATA_EMP->links('paginator.default') }}
                </div>
            </div>
        </section><!-- End Blog Single Section -->
    </main>
@endsection
@section('addjava')
    <script src="{{ asset('assets/atlantis/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $('body').keypress(function(e) {
            if (e.keyCode == 13) {
                $('#BTN_SEARCH').click();
            }
        });

        $('#RANK_SELECT').change(function() {
            var value = $(this).val();
            var seach_emp = $('#SEACH_EMP').val();
            url_link(value, seach_emp);
        });

        function url_link(value, seach_emp) {
            var url = "{{ route('homepage.employee') }}?RANK_NAME_ENG=" + value + '&SEARCH_EMP=' + seach_emp;
            window.location.href = url;
        }

        function search_emp() {
            var seach_emp = $('#SEACH_EMP').val();
            var value = $('#RANK_SELECT').val();
            url_link(value, seach_emp);
        }
    </script>
@endsection

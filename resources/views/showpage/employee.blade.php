@extends("master.master")
@section('body')
    <style>


    </style>
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('homepage') }}">หน้าแรก</a></li>
                    <li><a href="#">บุคลากร</a></li>
                    <li>ทั้งหมด</li>
                </ol>
                <h2>บุคลากร ทั้งหมด</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Single Section ======= -->
        <section id="blog" class="blog">
            <div class="container aos-init aos-animate" data-aos="fade-up">
                <div class="row">
                    <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- @foreach ($DETAIL_SCHOOL as $index => $row)
                        @php
                            $folder = $DATA_SCHOOL->DETAIL_TYPE;
                            $filename = $row->DETAIL_IMG . $row->DETAIL_IMG_EXT;
                            $position = $row->DETAIL_IMG_POSITION;
                        @endphp
                    @endforeach --}}
                </div>
            </div>
        </section><!-- End Blog Single Section -->
    </main>
@endsection
@section('addjava')
@endsection

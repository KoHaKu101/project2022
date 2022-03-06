@extends("master.master")
@section('body')
    <!-- ======= Contact Section ======= -->
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('homepage') }}">หน้าแรก</a></li>
                    <li>ติดต่อ</li>
                </ol>
                <h2>ติดต่อ</h2>
            </div>
        </section>
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>ติดต่อ</h2>
                </div>
                @php
                    $CONTRACT_MAP = $DATA_CONTRACT->where('CONTRACT_TYPE', '=', 'MAP')->first();
                    $locationmap = isset($CONTRACT_MAP->CONTRACT_DATA) ? $CONTRACT_MAP->CONTRACT_DATA : '';
                    $CONTRACT_EMAIL = $DATA_CONTRACT->where('CONTRACT_TYPE', '=', 'EMAIL');
                    $CONTRACT_TEL = $DATA_CONTRACT->where('CONTRACT_TYPE', '=', 'TEL');
                @endphp
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <i class="bx bx-map"></i>
                                    <h3>สถานที่ติดต่อ</h3>
                                    <iframe width="80%" height="460"
                                        src="https://maps.google.com/maps?q={{ $locationmap }}&t=&z=17&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box ">
                                    <i class="bx bx-envelope"></i>
                                    <h3>อีเมลติดต่อ</h3>
                                    @foreach ($CONTRACT_EMAIL as $index_email => $row_email)
                                        <p>{{ $row_email->CONTRACT_DATA }}<br></p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="info-box ">
                                    <i class="bx bx-phone-call"></i>
                                    <h3>เบอร์โทรติดต่อ</h3>
                                    @foreach ($CONTRACT_TEL as $index_tel => $row_tel)
                                        <p>{{ $row_tel->CONTRACT_DATA }}<br></p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->
@endsection
@section('addjava')
    <script>
        function show_post(thisdata) {
            var month = $(thisdata).data('month');
            var url = "{{ route('homepage.showpost') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    MONTH: month
                },
                success: function(response) {
                    $('#SHOW_POST').html(response.show_post);
                }
            });
        }
    </script>
@endsection

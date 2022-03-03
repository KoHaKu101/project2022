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
                    <li><a href="#">ข้อมูลพื้นฐานโรงเรียน</a></li>
                    <li>{{ $DATA_SCHOOL->DETAIL_HEAD }}</li>
                </ol>
                <h2>{{ $DATA_SCHOOL->DETAIL_HEAD }}</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Single Section ======= -->
        <section id="blog" class="blog">
            <div class="container aos-init aos-animate" data-aos="fade-up">

                <div class="row">
                    @foreach ($DETAIL_SCHOOL as $index => $row)
                        @php
                            $folder = $DATA_SCHOOL->DETAIL_TYPE;
                            $filename = $row->DETAIL_IMG . $row->DETAIL_IMG_EXT;
                            $position = $row->DETAIL_IMG_POSITION;
                        @endphp
                        @if ($position == 'TOP' || $position == 'BOTTON' || !isset($position))
                            <div class="col-lg-10 entries me-auto ms-auto">
                                <article class="entry entry-single">
                                    @if ($position == 'TOP')
                                        <div class="entry-img">
                                            <img src="{{ asset('assets/image/school/' . $folder . '/' . $filename) }}"
                                                alt="" class="img-fluid">
                                        </div>
                                    @endif
                                    <h2 class="entry-title">
                                        <a href="blog-single.html">{{ $row->DETAIL_HEAD }}</a>
                                    </h2>
                                    <div class="entry-content">
                                        <p>
                                            {!! nl2br($row->DETAIL_TEXT) !!}
                                        </p>
                                    </div>
                                    @if ($position == 'BOTTON')
                                        <div class="entry-img">
                                            <img src="{{ asset('assets/image/school/' . $folder . '/' . $filename) }}"
                                                alt="" class="img-fluid">
                                        </div>
                                    @endif
                                </article><!-- End blog entry -->
                            </div><!-- End blog entries list -->
                        @elseif($position == 'LEFT' || $position == 'RIGHT')
                            <div class="col-lg-10 entries me-auto ms-auto">
                                <article class="entry entry-single">
                                    <div class="row">
                                        @if ($position == 'LEFT')
                                            <div class="col-md-6">
                                                <div class="entry-img">
                                                    <img src="{{ asset('assets/image/school/' . $folder . '/' . $filename) }}"
                                                        alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <h2 class="entry-title">
                                                <a href="blog-single.html">{{ $row->DETAIL_HEAD }}</a>
                                            </h2>
                                            <div class="entry-content">
                                                <p>
                                                    {!! nl2br($row->DETAIL_TEXT) !!}
                                                </p>
                                            </div>
                                        </div>
                                        @if ($position == 'RIGHT')
                                            <div class="col-md-6">
                                                <div class="entry-img">
                                                    <img src="{{ asset('assets/image/school/' . $folder . '/' . $filename) }}"
                                                        alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </article><!-- End blog entry -->
                            </div><!-- End blog entries list -->
                        @endif
                    @endforeach

                </div>
            </div>
        </section><!-- End Blog Single Section -->
    </main>
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

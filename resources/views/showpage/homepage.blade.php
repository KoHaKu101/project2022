@extends("master.master")
@section('body')
    <style>
        .img-slide-show {
            min-height: 510px !important;
            max-height: 510px !important;
        }

        .indent {
            text-indent: 2.5em;
        }

    </style>
    <section class=" d-flex align-items-center">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleCaptions" class="carousel slide img-slide-show" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($IMG_SLIDE as $key => $row)
                            <button type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide-to="{{ $key }}"
                                {{ $key == 0 ? 'class=active aria-current=true' : '' }}
                                aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @php
                            $IMG__PATH = 'slide_noimg.png';
                            $IMG_NUMBER = 0;
                        @endphp
                        @foreach ($IMG_SLIDE as $key => $row)
                            @php
                                $IMG_ACTIVE = $row->IMG_NUMBER == 1 ? 'active' : '';
                                $IMG__PATH = $row->IMG_FILE . $row->IMG_EXT;
                            @endphp
                            <div class="carousel-item {{ $IMG_ACTIVE }}">
                                <img src="{{ asset('assets/image/slideshow/' . $IMG__PATH) }}" class="d-block w-100 ">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <main id="main">
        <!-- ======= About Section ======= -->
        <style>
            .img-notfound {
                height: 299px;
                widows: 243px;
            }

        </style>
        @php
            $STYLE_IMG = isset($DATA_DIRCETOR->DIRCETOR_IMG) ? '' : 'img-notfound';
        @endphp
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">
                <div class="row no-gutters">
                    <div class="content col-xl-5 d-flex align-items-stretch">
                        <img src="{{ asset('assets/image/people/' . $DIRECTOR_IMG) }}"
                            class="rounded mx-auto d-block {{ $STYLE_IMG }} img-fluid"
                            style="width: 245px;height: 249px;">
                    </div>
                    @if (isset($DATA_DIRCETOR))
                        <div class="col-xl-7 d-flex align-items-stretch">
                            <div class="icon-boxes d-flex flex-column justify-content-center">
                                <div class="card">
                                    <div class="card-body text-black">
                                        <h2 class="text-center">
                                            <b>สาส์นจากผู้อำนวยการ <br></b>
                                        </h2>
                                        <h5 class="indent">
                                            {{ isset($DATA_DIRCETOR->DIRCETOR_TEXT) ? $DATA_DIRCETOR->DIRCETOR_TEXT : '' }}
                                            <br>
                                            <br>
                                        </h5>
                                        <h3 class="text-center text-primary">
                                            {{ isset($DATA_DIRCETOR->DIRCETOR_TEXT_NAME) ? $DATA_DIRCETOR->DIRCETOR_TEXT_NAME : '' }}
                                            <br>
                                            {{ isset($DATA_DIRCETOR->DIRCETOR_SCHOOL) ? $DATA_DIRCETOR->DIRCETOR_SCHOOL : '' }}
                                            <br>
                                        </h3>
                                    </div>
                                </div>
                            </div><!-- End .content-->
                        </div>
                    @endif

                </div>

            </div>
        </section><!-- End About Section -->
        <!-- ======= Tabs Section ======= -->
        <style>
            a.active.show {
                background-color: #a364d3 !important;
                border-color: #a364d3 !important;
            }

        </style>
        <section id="tabs" class="tabs">
            <div class="container" data-aos="fade-up">
                <ul class="nav nav-tabs row d-flex">
                    @foreach ($ABOUT_SCHOOL as $index => $row_about)
                        @php
                            $ABOUT_NUMBER = count($ABOUT_SCHOOL);
                            $COL_COSTOM = $ABOUT_NUMBER == 1 ? 'col-lg-12' : ($ABOUT_NUMBER == 2 ? 'col-lg-' . +6 : ($ABOUT_NUMBER > 2 ? 'col-lg-' . +3 : 'col-lg-12'));
                            $ACTIVE_ABOUT = $row_about->ABOUT_NUMBER == 1 ? 'active show' : '';
                        @endphp
                        <li class="nav-item {{ $COL_COSTOM }} ">
                            <a class="nav-link {{ $ACTIVE_ABOUT }} " data-bs-toggle="tab"
                                data-bs-target="{{ '#about_tab-' . $row_about->ABOUT_NUMBER }}">
                                <i class="ri-gps-line"></i>
                                <h4 class="d-lg-block">{{ $row_about->ABOUT_NAME }}</h4>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($ABOUT_SCHOOL as $sub_index => $row_subabout)
                        @php
                            $ACTIVE_SUB_ABOUT = $row_subabout->ABOUT_NUMBER == 1 ? 'active show' : '';
                        @endphp
                        <div class="tab-pane {{ $ACTIVE_SUB_ABOUT }}"
                            id="{{ 'about_tab-' . $row_subabout->ABOUT_NUMBER }}">
                            <div class="row">
                                @if ($row_subabout->ABOUT_IMG == null)
                                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <h3>{{ $row_subabout->ABOUT_NAME }}</h3>
                                        <p>
                                            {{ $row_subabout->ABOUT_TEXT }}
                                        </p>
                                    </div>
                                @elseif($row_subabout->ABOUT_IMG_POSITION == 'LEFT')
                                    <div class="col-lg-6 order-2 order-lg-1 text-center" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <img src="{{ asset('assets/image/about/' . $row_subabout->ABOUT_IMG . $row_subabout->ABOUT_IMG_EXT) }}"
                                            alt="{{ $row_subabout->ABOUT_NAME }}" style="width:416px;height:312px">
                                    </div>
                                    <div class="col-lg-6 order-1 order-lg-2 mt-3 mt-lg-0" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <h3>{{ $row_subabout->ABOUT_NAME }}</h3>
                                        <p>
                                            {{ $row_subabout->ABOUT_TEXT }}
                                        </p>
                                    </div>
                                @elseif($row_subabout->ABOUT_IMG_POSITION == 'RIGHT')
                                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <h3>{{ $row_subabout->ABOUT_NAME }}</h3>
                                        <p>
                                            {{ $row_subabout->ABOUT_TEXT }}
                                        </p>
                                    </div>
                                    <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <img src="{{ asset('assets/image/about/' . $row_subabout->ABOUT_IMG . $row_subabout->ABOUT_IMG_EXT) }}"
                                            alt="{{ $row_subabout->ABOUT_NAME }}" class="img-fluid">
                                    </div>
                                @else
                                @endif

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section><!-- End Tabs Section -->
        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>ข่าวสารศูนย์พัฒนาเด็กเล็ก</h2>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" data-month="0" onclick="show_post(this)">ทั้งหมด</li>
                            @php
                                $months_full_th = ['1' => 'มกราคม', '2' => 'กุมภาพันธ์', '3' => 'มีนาคม', '4' => 'เมษายน', '5' => 'พฤษภาคม', '6' => 'มิถุนายน', '7' => 'กรกฎาคม', '8' => 'สิงหาคม', '9' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'];
                                $months_th = ['1' => 'ม.ค.', '2' => 'ก.พ.', '3' => 'มี.ค.', '4' => 'เม.ย', '5' => 'พ.ค.', '6' => 'มิ.ย.', '7' => 'ก.ค.', '8' => 'ส.ค.', '9' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.'];
                            @endphp
                            @for ($i = 1; $i <= 12; $i++)
                                <li data-filter=".month_{{ $i }}"
                                    class="{{ $i == date('n') ? 'filter-active' : '' }}"
                                    data-month="{{ $i }}" onclick="show_post(this)">
                                    {{ $months_th[$i] }}
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
                <style>
                    .text-check-long {
                        text-indent: 2.5em;
                        display: -webkit-box;
                        -webkit-line-clamp: 4;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }

                    .title-check-long {
                        display: -webkit-box;
                        -webkit-line-clamp: 1;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }

                </style>
                <div class="SHOW_POST">
                    <div class="row portfolio-container " data-aos="fade-up" data-aos-delay="200">
                        @foreach ($DATA_POST as $index_post => $row_post)
                            <div class="col-lg-4 col-md-6 portfolio-item month_{{ $row_post->POST_MONTH }}">
                                <article class="card ">
                                    <div class="card-body">
                                        <div class="entry-img text-center">
                                            <img src="{{ asset('assets/image/post/logo/' . $row_post->POST_IMG_LOGO . $row_post->POST_IMG_EXT) }}"
                                                alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <h2 class="entry-title text-center">
                                            <a href="blog-single.html" class="title-check-long"
                                                style="font-size: 25px">{{ $row_post->POST_HEADER }}</a>
                                        </h2>
                                        <div class="entry-content ">
                                            <p class="text-check-long">
                                                {{ $row_post->POST_BODY }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="entry-content ">
                                            <i class="bi bi-clock me-2"></i>
                                            {{ $row_post->POST_DAY . ' ' . $months_full_th[$row_post->POST_MONTH] . ' ' . ($row_post->POST_YEAR + 543) }}
                                            <div class="read-more  my-3 text-center">
                                                <a href="blog-single.html">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                    </div>
                    <div class="col-md-2 ">
                        <a href="#" class="btn btn-primary mr-4">
                            <i class="fas fa-hand-point-right me-2"></i>อ่านข่าวทั้งหมด</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======= Contact Section ======= -->
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

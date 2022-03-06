@extends("master.master")
@section('body')
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
    {{-- DATA_TAG --}}
    {{-- POST_TAG --}}
    {{-- DATA_POST --}}
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('homepage') }}">หน้าแรก</a></li>
                    <li><a href="#">ข่าวสาร</a></li>
                    <li>{{ isset($DATA_TAG->TAG_NAME) ? $DATA_TAG->TAG_NAME : 'ทั้งหมด' }}</li>
                </ol>
                <h2>
                    {{ isset($DATA_TAG->TAG_NAME) ? $DATA_TAG->TAG_NAME : 'ทั้งหมด' }}
                </h2>

            </div>
        </section>
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
                                    class="{{ $i == date('n') ? 'filter-active' : '' }}" data-month="{{ $i }}"
                                    onclick="show_post(this)">
                                    {{ $months_th[$i] }}
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>

                <div class="SHOW_POST">
                    <div class="row portfolio-container " data-aos="fade-up" data-aos-delay="200">
                        @php

                        @endphp
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
                                            <a href="{{ route('homepage.post_detail') . '?HEADER=' . $row_post->POST_HEADER }}"
                                                class="title-check-long"
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
                                                <a
                                                    href="{{ route('homepage.post_detail') . '?HEADER=' . $row_post->POST_HEADER }}">
                                                    Read More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if (isset($DATA_TAG->TAG_NAME))
                    {{ $DATA_POST->appends(['TAG' => $DATA_TAG->TAG_NAME])->links('paginator.homepage') }}
                @else
                    {{ $DATA_POST->links('paginator.homepage') }}
                @endif
            </div>
        </section>

    </main>
@endsection
@section('addjava')
    <script src="{{ asset('assets/atlantis/js/plugin/datatables/datatables.min.js') }}"></script>
@endsection

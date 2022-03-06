@extends("master.master")
@section('body')
    {{-- DATA_POST
POST_IMG
POST_TAG --}}
    <style>
        .disabled {
            pointer-events: none;
            cursor: default;
        }

    </style>
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('homepage') }}">หน้าแรก</a></li>
                    <li><a href="#">ข้อมูลพื้นฐานโรงเรียน</a></li>
                    <li>
                        {{ $DATA_POST->POST_HEADER }}
                        <span class="ms-4"><i class="fas fa-tags me-2"></i>กลุ่ม
                            @foreach ($POST_TAG as $index => $row)
                                <a href="{{ route('homepage.post_tag') . '?TAG=' . $row->TAG_NAME }}">
                                    {{ $row->TAG_NAME }}
                                </a>,
                            @endforeach

                        </span>
                    </li>
                </ol>
                <h2>{{ $DATA_POST->POST_HEADER }}</h2>

        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Single Section ======= -->
        <section id="blog" class="blog">
            <div class="container aos-init aos-animate" data-aos="fade-up">

                <div class="row">


                    @php
                        $POST_TYPE = $DATA_POST->POST_TYPE;
                    @endphp
                    @if ($POST_TYPE == 'DEFAULT')
                        @php
                            $position = $POST_IMG[0]->POST_IMG_POSITION;
                        @endphp
                        @if ($position == 'TOP' || $position == 'BOTTON' || !isset($position))

                            <div class="col-lg-10 entries me-auto ms-auto">
                                <div class="col-md-3">
                                    <a href="{{ url()->previous() }} " class="btn btn-warning"><i
                                            class="fas fa-arrow-circle-left me-2"></i>ย้อนกลับ</a>
                                </div>
                                <article class="entry entry-single">
                                    @if ($position == 'TOP')
                                        @foreach ($POST_IMG as $subindex => $subrow)
                                            @php
                                                $filename = $sPDF . $subrow->POST_IMG_EXT;
                                            @endphp
                                            <div class="entry-img">
                                                <img src="{{ asset('assets/image/post/img/' . $filename) }}" alt=""
                                                    class="img-fluid">
                                            </div>
                                        @endforeach
                                    @endif
                                    <h2 class="entry-title">
                                        <a href="#" class="disabled">{{ $DATA_POST->POST_HEADER }}</a>
                                    </h2>
                                    <div class="entry-content">
                                        <p>
                                            {!! nl2br($DATA_POST->POST_BODY) !!}
                                        </p>
                                    </div>
                                    @if ($position == 'BOTTON')
                                        <div class="entry-img">
                                            @foreach ($POST_IMG as $subindex => $subrow)
                                                @php
                                                    $filename = $subrow->POST_IMG_NAME . $subrow->POST_IMG_EXT;
                                                @endphp
                                                <div class="entry-img text-center form-inline">
                                                    <img src="{{ asset('assets/image/post/img/' . $filename) }}" alt=""
                                                        class="img-fluid">
                                                </div>
                                            @endforeach

                                        </div>
                                    @endif
                                </article><!-- End blog entry -->
                            </div><!-- End blog entries list -->
                        @elseif($position == 'LEFT' || $position == 'RIGHT')
                            <div class="col-lg-10 entries me-auto ms-auto">
                                <div class="col-md-3">
                                    <a href="{{ url()->previous() }} " class="btn btn-warning"><i
                                            class="fas fa-arrow-circle-left me-2"></i>ย้อนกลับ</a>
                                </div>
                                <article class="entry entry-single">
                                    <div class="row">
                                        @if ($position == 'LEFT')
                                            <div class="col-md-6">
                                                @foreach ($POST_IMG as $subindex => $subrow)
                                                    @php
                                                        $filename = $subrow->POST_IMG_NAME . $subrow->POST_IMG_EXT;
                                                    @endphp
                                                    <div class="entry-img">
                                                        <img src="{{ asset('assets/image/post/img/' . $filename) }}"
                                                            alt="" class="img-fluid">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <h2 class="entry-title">
                                                <a href="#" class="disabled">{{ $DATA_POST->POST_HEADER }}</a>
                                            </h2>
                                            <div class="entry-content">
                                                <p>
                                                    {!! nl2br($DATA_POST->POST_BODY) !!}
                                                </p>
                                            </div>
                                        </div>
                                        @if ($position == 'RIGHT')
                                            <div class="col-md-6">
                                                @foreach ($POST_IMG as $subindex => $subrow)
                                                    @php
                                                        $filename = $subrow->POST_IMG_NAME . $subrow->POST_IMG_EXT;
                                                    @endphp
                                                    <div class="entry-img">
                                                        <img src="{{ asset('assets/image/post/img/' . $filename) }}"
                                                            alt="" class="img-fluid">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </article><!-- End blog entry -->
                            </div><!-- End blog entries list -->
                        @endif
                    @else
                        <div class="col-lg-10 entries me-auto ms-auto">
                            <div class="col-md-3">
                                <a href="{{ url()->previous() }} " class="btn btn-warning"><i
                                        class="fas fa-arrow-circle-left me-2"></i>ย้อนกลับ</a>
                            </div>
                            <article class="entry entry-single">
                                <h2 class="entry-title">
                                    <a href="#" class="disabled">{{ $DATA_POST->POST_HEADER }}</a>
                                </h2>
                                <div class="entry-content">
                                    <p>
                                        {!! nl2br($DATA_POST->POST_BODY) !!}
                                    </p>
                                </div>
                                <div class="entry-img">
                                    @php
                                        $filename = $DATA_POST->POST_PDF . $DATA_POST->POST_PDF_EXT;
                                    @endphp
                                    <div class="entry-img  form-inline" style="width:100%;height:2000px">
                                        <a href="{{ route('download.pdf') . '?UNID=' . $DATA_POST->UNID }}"
                                            class="btn btn-primary my-2 btn-block" style="font-size:20px;">
                                            <i class="fas fa-external-link-square-alt me-2"></i>ดาวโหลด
                                        </a>
                                        <button type="button" class="btn btn-primary my-2 btn-block"
                                            style="font-size:20px;float: right;" onclick="open_pdf(this)"
                                            data-name="{{ $DATA_POST->POST_PDF . $DATA_POST->POST_PDF_EXT }}">
                                            <i class="fas fa-external-link-square-alt me-2"></i>เปิดไฟล์
                                        </button>
                                        <iframe
                                            src="{{ asset('assets/pdf/post/' . $DATA_POST->POST_PDF . $DATA_POST->POST_PDF_EXT) }}"
                                            width="100%" height="100%"></iframe>

                                    </div>

                                </div>
                            </article><!-- End blog entry -->
                        </div><!-- End blog entries list -->
                    @endif
                </div>
            </div>
        </section><!-- End Blog Single Section -->
    </main>
@endsection
@section('addjava')
@endsection

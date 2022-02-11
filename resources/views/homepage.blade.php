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
                        @for ($i_silde = 0; $i_silde < 5; $i_silde++)
                            <button type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide-to="{{ $i_silde }}"
                                {{ $i_silde == 0 ? 'class=active aria-current=true' : '' }}
                                aria-label="Slide {{ $i_silde + 1 }}"></button>
                        @endfor
                    </div>
                    <div class="carousel-inner">
                        @php
                            $IMG__PATH = 'slide_noimg.png';
                            $IMG_NUMBER = 0;
                        @endphp
                        @for ($i = 1; $i <= $LIMIT_NUMBER; $i++)
                            @php
                                if ($IMG_SLIDE) {
                                    $IMG = $IMG_SLIDE->where('IMG_NUMBER', '=', $i)->first();
                                    $IMG_NUMBER = $IMG->IMG_NUMBER;
                                    $IMG__PATH = $IMG->IMG_FILE . $IMG->IMG_EXT;
                                }
                            @endphp
                            <div class="carousel-item {{ $IMG_NUMBER == 1 ? 'active' : '' }}">
                                <img src="{{ asset('assets/image/slideshow/' . $IMG__PATH) }}" class="d-block w-100 ">
                            </div>
                        @endfor
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
        @php
            $IMG_DIRECTOR = isset($IMG_DIRECTOR->IMG_FILE) ? $IMG_DIRECTOR->IMG_FILE . $IMG_DIRECTOR->IMG_EXT : 'no_img.png';
        @endphp
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">
                <div class="row no-gutters">
                    <div class="content col-xl-5 d-flex align-items-stretch">
                        <img src="{{ asset('assets/image/people/director.png') }}" class="rounded mx-auto d-block">
                    </div>
                    <div class="col-xl-7 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="card">
                                <div class="card-body text-black">
                                    <h2 class="text-center">
                                        <b>สาส์นจากผู้อำนวยการ <br></b>
                                    </h2>
                                    <h5 class="indent">
                                        ขอขอบคุณผู้ปกครองนักเรียน
                                        นักศึกษาที่ให้ความไว้วางใจวิทยาลัยที่ให้ความร่วมมืออย่างดีในกิจกรรมต่างๆ
                                        ของวิทยาลัยฯ
                                        ขอขอบใจนักเรียนนักศึกษาทุกคนที่ปฏิบัติตนอยู่ในระเบียบของวิทยาลัย
                                        อยู่ในโอวาทของทุกคน
                                        เป็นนักเรียนนักศึกษาที่ วิทยาลัยภาคภูมิใจ
                                        <br>
                                        <br>
                                    </h5>
                                    <h3 class="text-center text-primary">
                                        นายอาคม จันทร์นาม <br>
                                        ผู้อำนวยการศูนย์พัฒนาเด็กเล็ก บ้านหนองคูโคก <br>
                                    </h3>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->
        <!-- ======= Tabs Section ======= -->
        <section id="tabs" class="tabs">
            <div class="container" data-aos="fade-up">
                <ul class="nav nav-tabs row d-flex">
                    <li class="nav-item col-6">
                        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                            <i class="ri-gps-line"></i>
                            <h4 class="d-none d-lg-block">ความเป็นมาศูนย์พัฒนาเด็กเล็ก</h4>
                        </a>
                    </li>
                    <li class="nav-item col-6">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                            <i class="ri-body-scan-line"></i>
                            <h4 class="d-none d-lg-block">คำขวัญศูนย์พัฒนาเด็กเล็ก</h4>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab-1">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
                                <h3>ความเป็นมาศูนย์พัฒนาเด็กเล็ก</h3>
                                <p class="fst-italic">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                    magna aliqua.
                                </p>
                                <ul>
                                    <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat.</li>
                                    <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit
                                        in
                                        voluptate velit.</li>
                                    <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        trideta
                                        storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                                </ul>
                                <p>
                                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in
                                    reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                    cupidatat
                                    non proident, sunt in
                                    culpa qui officia deserunt mollit anim id est laborum
                                </p>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                                <img src="assets/img/tabs-1.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-2">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>คำขวัญศูนย์พัฒนาเด็กเล็ก</h3>
                                <p>
                                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in
                                    reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                    cupidatat
                                    non proident, sunt in
                                    culpa qui officia deserunt mollit anim id est laborum
                                </p>
                                <p class="fst-italic">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                    magna aliqua.
                                </p>
                                <ul>
                                    <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat.</li>
                                    <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit
                                        in
                                        voluptate velit.</li>
                                    <li><i class="ri-check-double-line"></i> Provident mollitia neque rerum
                                        asperiores
                                        dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</li>
                                    <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        trideta
                                        storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="assets/img/tabs-2.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
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
                            <li data-filter="*" class="filter-active">ทั้งหมด</li>
                            @php
                                $months_full_th = ['1' => 'มกราคม', '2' => 'กุมภาพันธ์', '3' => 'มีนาคม', '4' => 'เมษายน', '5' => 'พฤษภาคม', '6' => 'มิถุนายน', '7' => 'กรกฎาคม', '8' => 'สิงหาคม', '9' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'];
                                $months_th = ['1' => 'ม.ค.', '2' => 'ก.พ.', '3' => 'มี.ค.', '4' => 'เม.ย', '5' => 'พ.ค.', '6' => 'มิ.ย.', '7' => 'ก.ค.', '8' => 'ส.ค.', '9' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.'];
                            @endphp
                            @for ($i = 1; $i <= 12; $i++)
                                <li data-filter=".month-{{ $i }}">{{ $months_th[$i] }}</li>
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

                </style>
                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @for ($post = 1; $post <= 12; $post++)
                        <div class="col-lg-4 col-md-6 portfolio-item month-{{ $post }}">
                            <article class="entry">
                                <div class="entry-img">
                                    <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                                </div>
                                <h2 class="entry-title">
                                    <a href="blog-single.html">ตรวจวัดอุณหภูมิ</a>
                                </h2>
                                <div class="entry-content">
                                    <p class="text-check-long">
                                        Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi
                                        praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                                        Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi
                                        praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                                    </p>
                                    <i class="bi bi-clock me-2"></i>
                                    {{ date('d ') . $months_full_th[$post] . date(' Y ') }}
                                    <div class="read-more  my-3">
                                        <a href="blog-single.html">Read More</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @if ($post >= 6)
                        @break
                    @endif
                    @endfor
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
                    $locationmap = '16.051926472973367,103.64722590286577';
                @endphp
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <i class="bx bx-map"></i>
                                    <h3>Our Address</h3>
                                    <iframe width="80%" height="460"
                                        src="https://maps.google.com/maps?q={{ $locationmap }}&t=&z=17&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box ">
                                    <i class="bx bx-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>info@example.com<br>contact@example.com</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box ">
                                    <i class="bx bx-phone-call"></i>
                                    <h3>Call Us</h3>
                                    <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4 ">
                                <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                                    <div class="row">
                                        <div class="col form-group">
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Your Name" required>
                                        </div>
                                        <div class="col form-group">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Your Email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" id="subject"
                                            placeholder="Subject" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="5" placeholder="Message"
                                            required></textarea>
                                    </div>
                                    <div class="my-3">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Your message has been sent. Thank you!</div>
                                    </div>
                                    <div class="text-center"><button type="submit">Send Message</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->
@endsection

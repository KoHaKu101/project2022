<!-- ======= Header ======= -->
<style>
    #header .logo img {
        max-height: 75px;
    }

</style>

<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto">
            <a href="{{ route('homepage') }}">
                <img src="{{ asset('assets/image/logoschool/makelogo.png') }}">
            </a>
        </h1>
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active" href="{{ route('homepage') }}">หน้าแรก</a></li>
                <li class="dropdown">
                    <a href="#">
                        <span>ข้อมูลพื้นฐานโรงเรียน</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        @php
                            use App\Models\DetailSchool;
                            use App\Models\DetailId;
                            $DATA_DETAIL = DetailId::select('UNID', 'DETAIL_HEAD', 'DETAIL_TYPE')
                                ->where('DETAIL_STATUS', '=', 'OPEN')
                                ->get();
                        @endphp
                        @foreach ($DATA_DETAIL as $index_detail => $row_detail)
                            <li>
                                <a href="{{ route('homepage.detail', ['DETAIL_TYPE' => $row_detail->DETAIL_TYPE]) }}">
                                    {{ $row_detail->DETAIL_HEAD }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="#">บุคลากร</a></li>
                <li class="dropdown">
                    <a href="#">
                        <span>ข่าวสาร</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>

                        <li><a href="#">sss</a></li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="#">ติดต่อ</a></li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
        @if (isset(Auth::user()->USERNAME))
            <div class="dropdown">
                <button class="btn btn-danger get-started-btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->FIRST_NAME }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @if (Auth::user()->ROLE == 'ADMIN')
                        <li><a class="dropdown-item" href="{{ route('edit.home') }}">แก้ไขเว็บไซต์</a></li>
                    @endif
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">ออกจากระบบ</a></li>
                </ul>
            </div>
        @else
            <button type="button" class="btn btn-danger get-started-btn" onclick="showmodallogin()">เข้าสู่ระบบ</button>
        @endif

        {{-- <a href="#about" class="get-started-btn scrollto">เข้าสู่ระบบ</a> --}}
    </div>
</header>

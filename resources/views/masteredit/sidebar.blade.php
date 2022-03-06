<!-- Sidebar -->
<style>
    li.nav-item {
        margin-top: 1rem !important;
    }

    .bg-purple {
        background-color: #a364d3 !important;

    }

    .btn-self {
        font-size: 16px;
        padding: 4px 13px;
    }

</style>
@php
$current_page = Request::segment(2);
@endphp
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('assets/image/editprofile/adminprofile.png') }}" alt="..."
                        class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true" style="cursor:default">
                        <span>
                            {{ Auth::user()->FIRST_NAME }}
                            <span class="user-level">แอดมิน</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary ">
                <li class="nav-item {{ $current_page == 'home' ? 'active' : '' }}">
                    <a href="{{ route('edit.home') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>หน้าหลัก</p>
                    </a>
                </li>
                <li class="nav-item {{ $current_page == 'post' ? 'active' : '' }}">
                    <a href="{{ route('edit.post') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-newspaper"></i>
                        <p>ข่าวสาร</p>
                    </a>
                </li>
                <li class="nav-item  {{ $current_page == 'school' ? 'active' : '' }}">
                    <a href="{{ route('edit.school') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>ข้อมูลพื้นฐานโรงเรียน</p>
                    </a>
                </li>
                <li class="nav-item {{ $current_page == 'emp' ? 'active' : '' }}">
                    <a href="{{ route('edit.emp') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-user-graduate"></i>
                        <p>บุคลากร</p>
                    </a>
                </li>
                <li class="nav-item {{ $current_page == 'settingpage' ? 'active' : '' }}">
                    <a href="{{ route('edit.settingpage') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-wrench"></i>
                        <p>ตั้งค่าทั่วไป</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

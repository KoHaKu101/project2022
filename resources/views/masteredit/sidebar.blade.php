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
                <li class="nav-item active">
                    <a data-toggle="collapse" href="{{ route('edit.home') }}" class="collapsed"
                        aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>หน้าหลัก</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-newspaper"></i>
                        <p>ข่าวสาร</p>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>ข้อมูลพื้นฐานโรงเรียน</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>บุคลากร</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>ภาพกิจกรรม</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-wrench"></i>
                        <p>ตั้งค่าตัวไป</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

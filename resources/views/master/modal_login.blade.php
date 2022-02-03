<style>
    .btn-close-modal:hover {
        background-color: pink;
    }

    .label-click {
        cursor: pointer;
        color: red;
    }

    .label-click:hover {
        text-decoration: underline;
        color: rgb(182, 5, 5);
        text-decoration-color: rgb(182, 5, 5);
        ;
    }

    .span-register {
        cursor: pointer;
        color: rgb(31, 79, 235);
    }

    .span-register:hover {
        text-decoration: underline;
        color: rgb(21, 53, 160);
        text-decoration-color: rgb(21, 53, 160);
    }

</style>
<div class="modal fade" id="modallogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('assets/image/login/login1.jpg') }}" width="100%">
                </div>
                <div class="col-md-6">
                    <div class="modal-header">
                        <h5 class="modal-title" id="MODAL_NAME_LOGIN">เข้าสู่ระบบ / Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onclick="closmodallogin()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('login') }}" method="POST" id="FRM_LOGIN">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control" id="USERNAME" name="USERNAME"
                                            placeholder="ชื่อผู้ใช้" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">รหัสผ่าน</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="รหัสผ่าน" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember" />
                                        <label class="form-check-label" for="remember">จดจำฉัน</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3 ">
                                        <label class="label-click float-end" data-id="BTN_FORGET"
                                            onclick="hideandshow(this)">ลืมรหัสผ่าน</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 ">
                                        <button type="submit" class="btn btn-success w-100 ">ลงชื่อเข้าใช้</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="mb-3 ">
                                        <label>มีบัญชีเข้าใช้ระบบหรือยัง ? กด<span class="span-register"
                                                data-id="BTN_REGISTER" onclick="hideandshow(this)">สมัครบัญชี</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('register') }}" method="POST" id="FRM_REGISTER" hidden>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control" id="NEW_USERNAME" name="NEW_USERNAME"
                                            placeholder="ชื่อผู้ใช้" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">อีเมล</label>
                                        <input type="email" class="form-control" id="NEW_EMAIL" name="NEW_EMAIL"
                                            placeholder="อีเมล" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">รหัสผ่าน</label>
                                        <input type="password" class="form-control" id="NEW_PASSWORD"
                                            name="NEW_PASSWORD" placeholder="รหัสผ่าน" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">ยืนยันรหัสผ่าน</label>
                                        <input type="password" class="form-control" id="CONFIRM_PASSWORD"
                                            name="CONFIRM_PASSWORD" placeholder="รหัสผ่าน" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 ">
                                        <button type="submit" class="btn btn-success w-100 ">สมัครบัญชี</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="mb-3 ">
                                        <label>มีบัญชีอยู่แล้ว กด<span class="span-register" data-id="BTN_LOGIN"
                                                onclick="hideandshow(this)">เข้าสู่ระบบ</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="#" method="POST" id="FRM_FORGET_PASS" hidden>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">ชื่อผู้ใช้ / อีเมล</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="ชื่อผู้ใช้ / อีเมล" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-danger w-100 " data-id="BTN_LOGIN"
                                            onclick="hideandshow(this)"><i class="fas fa-arrow-alt-circle-left"></i>
                                            ย้อนกลับ</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 ">
                                        <button type="submit" class="btn btn-success w-100 ">ส่งรหัสผ่าน</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

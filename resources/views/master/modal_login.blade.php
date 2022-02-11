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

    label.text-danger-edit {
        color: red;
    }

    input.text-danger-edit {
        background-color: #f8d7da;
        border-color: #f5c2c7;
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
                            onclick="closemodallogin()"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="FRM_LOGIN" data-route="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label ER_USERNAME">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control ER_USERNAME" id="USERNAME"
                                            name="USERNAME" placeholder="ชื่อผู้ใช้" required>
                                        <p class="text-danger HIDE_USERNAME" hidden>
                                            <i class="fas fa-exclamation-circle"></i>
                                            กรุณากรอก ชื่อผู้ใช้ หรือ ชื่อผู้ใช้ผิดพลาด
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label ER_password">รหัสผ่าน</label>
                                        <input type="password" class="form-control ER_password" id="password"
                                            name="password" placeholder="รหัสผ่าน" required>
                                        <p class="text-danger HIDE_password" hidden>
                                            <i class="fas fa-exclamation-circle"></i>
                                            รหัสผ่านผิดพลาด
                                        </p>
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
                        <form method="POST" id="FRM_REGISTER" data-route="{{ route('register') }}" hidden>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label ER_NEW_FIRST_NAME">ชื่อจริง</label>
                                        <input type="text" class="form-control ER_NEW_FIRST_NAME" id="NEW_FIRST_NAME"
                                            name="NEW_FIRST_NAME" placeholder="ชื่อจริง" required>
                                        <p class="text-danger HIDE_NEW_FIRST_NAME" hidden>
                                            <i class="fas fa-exclamation-circle"></i>
                                            กรุณากรอกชื่อจริง
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label ER_NEW_LAST_NAME">นามสกุล</label>
                                        <input type="text" class="form-control ER_NEW_LAST_NAME" id="NEW_LAST_NAME"
                                            name="NEW_LAST_NAME" placeholder="นามสกุล" required>
                                        <p class="text-danger HIDE_NEW_LAST_NAME" hidden>
                                            <i class="fas fa-exclamation-circle"></i>
                                            กรุณากรอกนามสกุล
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label ER_NEW_USERNAME">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control ER_NEW_USERNAME" id="NEW_USERNAME"
                                            name="NEW_USERNAME" placeholder="ชื่อผู้ใช้" required>
                                        <p class="text-danger HIDE_NEW_USERNAME" hidden>
                                            <i class="fas fa-exclamation-circle"></i>
                                            ชื่อผู้ใช้ซ้ำ กรุณาลองใหม่
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label ER_NEW_EMAIL">อีเมล</label>
                                        <input type="email" class="form-control ER_NEW_EMAIL" id="NEW_EMAIL"
                                            name="NEW_EMAIL" placeholder="อีเมล" required>
                                        <p class="text-danger HIDE_NEW_EMAIL" hidden>
                                            <i class="fas fa-exclamation-circle"></i>
                                            อิเมลผิดพลาด
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 form-group ">
                                        <label class="form-label ER_NEW_PASSWORD">รหัสผ่าน</label>
                                        <input type="password" class="form-control ER_NEW_PASSWORD" id="NEW_PASSWORD"
                                            name="NEW_PASSWORD" placeholder="รหัสผ่าน" required>
                                        <p class="text-danger HIDE_NEW_PASSWORD" hidden>
                                            <i class="fas fa-exclamation-circle"></i>
                                            รหัสผ่านผิดพลาด
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label ER_NEW_PASSWORD">ยืนยันรหัสผ่าน</label>
                                        <input type="password" class="form-control ER_NEW_PASSWORD"
                                            id="CONFIRM_PASSWORD" name="CONFIRM_PASSWORD" placeholder="รหัสผ่าน"
                                            required>
                                        <p class="text-danger HIDE_CONFIRM_PASSWORD" hidden>
                                            <i class="fas fa-exclamation-circle"></i>
                                            รหัสผ่านผิดพลาด
                                        </p>
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

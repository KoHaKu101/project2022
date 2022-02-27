    <div class="modal fade" id="modal_post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="modal-header bg-primary">
                            <h3 class="modal-title" id="modal_post_title"></h3>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="wizard-container wizard-round col-md-12">
                                    <div class="wizard-body ">
                                        <div class="row">
                                            <ul class="wizard-menu nav nav-pills nav-primary ml-auto mr-auto">
                                                <li class="step">
                                                    <a class="nav-link active text-byme a-nopoint" id="step1_active"
                                                        aria-expanded="true">
                                                        <i class="fa fa-user mr-2"></i>ขั้นตอนแรก ประเถทข้อมูล
                                                    </a>
                                                </li>
                                                <li class="step">
                                                    <a class="nav-link text-byme a-nopoint" id="step2_active">
                                                        <i class="fa fa-file mr-2"></i> ขั้นตอนสอง ตำแหน่งรูปภาพ
                                                    </a>
                                                </li>
                                                <li class="step">
                                                    <a class="nav-link text-byme a-nopoint" id="step3_active">
                                                        <i class="fa fa-map-signs mr-2"></i> ใส่ข้อมูล</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content my-3">
                                            <div class="tab-pane active" id="step1">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h2>ขั้นตอนแรก ประเถทข้อมูล</h2>
                                                    </div>
                                                </div>
                                                <div class="row my-4">
                                                    <div class="col-md-6 text-right ">
                                                        <button type="button" class="btn btn-clay btn-lg text-byme-lg"
                                                            data-typepost="DEFAULT" id="BTN_DEFAULT"
                                                            onclick="post_step1(this)">
                                                            แบบข้อความ</button>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <button type="button" class="btn btn-clay btn-lg text-byme-lg"
                                                            data-typepost="PDF" id="BTN_PDF" onclick="post_step1(this)">
                                                            ไฟล์ หรือ pdf</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="step2">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h2>ขั้นตอนสอง ตำแหน่งรูปภาพ</h2>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 my-2 text-right">
                                                        <button type="button"
                                                            class="btn btn-clay btn-lg text-byme-lg TOP post_position"
                                                            data-position="TOP" onclick="post_step2(this)">
                                                            บน</button>
                                                    </div>
                                                    <div class="col-md-6 my-2 text-left">
                                                        <button type="button"
                                                            class="btn btn-clay btn-lg text-byme-lg BOTTON post_position"
                                                            data-position="BOTTON" onclick="post_step2(this)">
                                                            ล่าง</button>
                                                    </div>
                                                    <div class="col-md-6 my-2 text-right">
                                                        <button type="button"
                                                            class="btn btn-clay btn-lg text-byme-lg LEFT post_position"
                                                            data-position="LEFT" onclick="post_step2(this)">
                                                            ซ้าย</button>
                                                    </div>
                                                    <div class="col-md-6 my-2 text-left">
                                                        <button type="button"
                                                            class="btn btn-clay btn-lg text-byme-lg RIGHT post_position"
                                                            data-position="RIGHT" onclick="post_step2(this)">
                                                            ขวา</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="step3">
                                                <form action="{{ route('post.insert.default') }}"
                                                    id="FRM_POST_DEFAULT" method="POST" enctype="multipart/form-data"
                                                    hidden>
                                                    @csrf
                                                    <input type="hidden" id="POST_TYPE_DEFAULT"
                                                        name="POST_TYPE_DEFAULT">
                                                    <input type="hidden" id="POST_IMG_POSITION"
                                                        name="POST_IMG_POSITION">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h2>ใส่ข้อมูล</h2>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 POST_LOGODEFAULT_DIV">
                                                            <label>
                                                                <h3>ภาพแสดงตัวอย่าง</h3>
                                                            </label>
                                                            <input type="file" accept="image/*" class="form-control"
                                                                id="POST_LOGO" name="POST_LOGO">
                                                            <label class="float-right POST_LOGODEFAULT_LABLE" hidden>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 POST_IMGDEFAULT_DIV">
                                                            <label>
                                                                <h3>ภาพกิจกรรม / ภาพประกอบ </h3>
                                                                **(สามารถเพิ่มหลายรูปได้ โดยการ กด Ctrl ค้างไว้ แล้ว
                                                                คลิกเมาส์ซ้าย)**
                                                            </label>
                                                            <input type="file" class="form-control" id="POST_IMG"
                                                                name="POST_IMG[]" accept="image/*" multiple>
                                                            <label class="float-right POST_IMGDEFAULT_LABLE" hidden>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 POST_HEADERDEFAULT_DIV">
                                                            <label>
                                                                <h3>หัวข้อข่าวสาร</h3>
                                                            </label>
                                                            <input type="text" class="form-control" id="POST_HEADER"
                                                                name="POST_HEADER" placeholder="หัวข้อข่าวสาร">
                                                            <label class="float-right POST_HEADERDEFAULT_LABLE" hidden>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 POST_BODYDEFAULT_DIV">
                                                            <label>
                                                                <h3>คำอธิบาย</h3>
                                                            </label>
                                                            <textarea class="form-control" rows="10" id="POST_BODY"
                                                                name="POST_BODY" placeholder="คำอธิบาย"></textarea>
                                                            <label class="float-right POST_BODYDEFAULT_LABLE" hidden>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 POST_TAGDEFAULT_DIV">
                                                        </div>
                                                    </div>
                                                </form>
                                                <form action="#" id="FRM_POST_PDF" method="POST"
                                                    enctype="multipart/form-data" hidden>
                                                    @csrf
                                                    <input type="hidden" id="POST_TYPE_PDF" name="POST_TYPE_PDF">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h2>ใส่ข้อมูล</h2>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 POST_LOGOPDF_DIV">
                                                            <label>
                                                                <h3>ภาพแสดงตัวอย่าง</h3>
                                                            </label>
                                                            <input type="file" class="form-control" id="POST_LOGO"
                                                                name="POST_LOGO" accept="image/*" required>
                                                            <label class="float-right POST_LOGOPDF_LABLE" hidden>
                                                            </label>
                                                        </div>

                                                        <div class="col-md-12 POST_FILEPDF_DIV">
                                                            <label>
                                                                <h3>อัปโหลดไฟล์PDF</h3>
                                                            </label>
                                                            <input type="file" class="form-control" id="POST_FILE"
                                                                name="POST_FILE" required>
                                                            <label class="float-right POST_FILEPDF_LABLE" hidden>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 POST_HEADERPDF_DIV">
                                                            <label>
                                                                <h3>หัวข้อข่าวสาร</h3>
                                                            </label>
                                                            <input type="text" class="form-control" id="POST_HEADER"
                                                                name="POST_HEADER" placeholder="หัวข้อข่าวสาร">
                                                            <label class="float-right POST_HEADERPDF_LABLE" hidden>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 POST_BODYPDF_DIV">
                                                            <label>
                                                                <h3>คำอธิบาย</h3>
                                                            </label>
                                                            <textarea class="form-control" rows="5" id="POST_BODY"
                                                                name="POST_BODY" placeholder="คำอธิบาย"></textarea>
                                                            <label class="float-right POST_BODYPDF_LABLE" hidden>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 POST_TAGPDF_DIV">

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger mr-auto text-byme" data-dismiss="modal"
                                aria-label="Close" id="POST_BTN_CLOSE">
                                <i class="fas fa-times mx-2"></i>ยกเลิก
                            </button>
                            <button type="button" class="btn btn-danger mr-auto text-byme" data-step="1" id="BTN_RETURN"
                                onclick="return_step(this)" hidden>
                                <i class="fa fa-arrow-left mx-2"></i>ย้อนกลับ
                            </button>
                            <button type="button" class="btn btn-primary text-byme" data-step="2" id="BTN_NEXT"
                                onclick="next_step(this)">
                                <i class="fa fa-arrow-right mr-2" aria-hidden="true"></i>ต่อไป
                            </button>
                            <button type="button" class="btn btn-success text-byme" id="POST_BTN_SUBMIT"
                                onclick="post_submit()" hidden>
                                <i class="fas fa-save mr-2" aria-hidden="true"></i>บันทึก
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

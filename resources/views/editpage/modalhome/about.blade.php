<div class="modal fade" id="modal_about" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="modal-header bg-primary">
                        <h3 class="modal-title" id="MODAL_NAME_ABOUT"></h3>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="FRM_ABOUT" action="{{ route('about.insert') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="ABOUT_POSITION" name="ABOUT_POSITION" value="RIGHT">
                            <input type="hidden" id="ABOUT_UNID" name="ABOUT_UNID">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group has-error">
                                        <label>หัวข้อ</label>
                                        <input type="text" class="form-control " id="ABOUT_NAME" name="ABOUT_NAME"
                                            placeholder="กรุณาใส่หัวขอ เช่น ความเป็นมาของศูนย์" required>
                                    </div>
                                </div>
                                <style>
                                    .btn-disabled {
                                        cursor: not-allowed;
                                    }

                                </style>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="form-group">
                                            <label>ตำแหน่งของภาพ</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary btn-block"
                                                        onclick="about_postion(this)" id="BTN_LEFT"
                                                        data-position="LEFT">ภาพอยู่ซ้ายมือ</button>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <button type="button" class="btn btn-primary btn-block btn-disabled"
                                                        onclick="about_postion(this)" id="BTN_RIGHT"
                                                        data-position="RIGHT" disabled>ภาพอยู่ขวามือ</button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" id="DIV_RIGHT">
                                    <div class="form-group has-error">
                                        <label>ข้อมูล</label>
                                        <textarea class="form-control" rows="14" required
                                            placeholder="กรุณาใส่ข้อมูลในนี้" id="ABOUT_TEXT"
                                            name="ABOUT_TEXT"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6" id="DIV_LEFT">
                                    <div class="form-group ">
                                        <label>ภาพ</label>
                                        <input type="file" class="form-control" id="ABOUT_IMG" name="ABOUT_IMG">
                                        <div class="div_img">
                                            <img src="{{ asset('assets/image/postmassage/no_img.png') }}"
                                                id="SHOWABOUT_IMG" style="width: -webkit-fill-available;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger mr-auto text-byme" data-dismiss="modal"
                            aria-label="Close"><i class="fas fa-times mx-2"></i>ยกเลิก</button>
                        <button type="button" class="btn btn-danger" hidden id="BTN_DELETE_ABOUT" data-unid=""
                            onclick="deleteabout(this)">
                            <i class="fas fa-trash mx-2"></i>ลบ
                        </button>
                        <button type="button" class="btn btn-success text-byme" id="BTN_SUBMIT_ABOUT"
                            onclick="submit_about()">
                            <i class="fas fa-save mx-2"></i>บันทึก</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

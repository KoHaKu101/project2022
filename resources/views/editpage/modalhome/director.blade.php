<div class="modal fade" id="modal_director" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="modal-header bg-primary">
                        <h3 class="modal-title">สาส์นจากผู้อำนวยการ</h3>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="FRM_DIRECTOR" action="{{ route('director.post') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ข้อความ</label>
                                        <textarea class="form-control" id="DIRCETOR_TEXT" name="DIRCETOR_TEXT"
                                            rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ชื่อผู้อำนวยการ</label>
                                        <input type="text" class="form-control" id="DIRCETOR_NAME"
                                            name="DIRCETOR_NAME">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ชื่อโรงเรียน</label>
                                        <input type="text" class="form-control" id="DIRCETOR_SCHOOL"
                                            name="DIRCETOR_SCHOOL">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger text-byme" aria-label="Close">
                                <i class="fas fa-times mx-2"></i>
                                ยกเลิก
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-success text-byme" onclick="submit_director()">
                                <i class="fas fa-save mx-2"></i>
                                บันทึก
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

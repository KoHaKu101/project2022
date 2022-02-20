<script>
    $('#modal_about').on('hidden.bs.modal', function() {

        var url_insert = "{{ route('about.insert') }}";
        var asset_make = "{{ asset('/') }}" + 'assets/image/postmassage/no_img.png';
        $('.div_img').html('<img src="' + asset_make +
            '"id = "SHOWABOUT_IMG" style = "width: -webkit-fill-available;" > ');
        $('#BTN_SUBMIT_ABOUT').html('<i class="fas fa-save mx-2"></i>บันทึก');
        $('#BTN_RIGHT').click();
        $('#FRM_ABOUT').attr('action', url_insert);
        $('#BTN_DELETE_ABOUT').attr('data-unid', '');
        $('#ABOUT_UNID').val('');
        $('#BTN_DELETE_ABOUT').attr('hidden', true);
        $('#FRM_ABOUT')[0].reset();
    })

    function modal_about(thisdata) {
        var MODAL_TITLE = $(thisdata).data('name');
        $('#MODAL_NAME_ABOUT').html(MODAL_TITLE);
        $('#modal_about').modal('show');
    }

    function modal_about_data(thisdata) {
        var MODAL_TITLE = $(thisdata).data('name');
        var UNID = $(thisdata).data('unid');
        var url = "{{ route('about.show') }}";
        $.ajax({
            type: "GET",
            url: url,
            data: {
                ABOUT_UNID: UNID
            },
            success: function(response) {
                if (response.status == 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'กรุณาติดต่อแอดมินหรือลองใหม่อีกครั้ง',
                    });
                } else {
                    var url_update = "{{ route('about.update') }}";
                    $('#MODAL_NAME_ABOUT').html('แก้ไข : ' +
                        MODAL_TITLE);
                    $('#ABOUT_UNID').val(UNID);
                    $('#ABOUT_NAME').val(response.ABOUT_NAME);
                    $('#ABOUT_TEXT').val(response.ABOUT_TEXT);
                    $('#BTN_DELETE_ABOUT').attr('data-unid', UNID);
                    $('#FRM_ABOUT').attr('action', url_update);
                    var asset_make = "{{ asset('/') }}" + 'assets/image/postmassage/no_img.png';
                    if (response.ABOUT_IMG != '') {
                        asset_make = "{{ asset('/assets/image/about') }}/" + response.ABOUT_IMG;
                    }
                    $('.div_img').html('<img src="' + asset_make +
                        '"id = "SHOWABOUT_IMG" style = "width: -webkit-fill-available;" > ');
                    $('#BTN_' + response.ABOUT_POSTION).click();
                    $('#BTN_SUBMIT_ABOUT').html('<i class="fas fa-edit mx-2"></i>แก้ไข');
                    $('#BTN_DELETE_ABOUT').attr('hidden', false);
                    $('#modal_about').modal('show');
                }
            }
        });

    }

    function about_postion(thisdata) {
        var position_show = $(thisdata).data('position');
        var position_hide = position_show == 'RIGHT' ? 'LEFT' : 'RIGHT';
        $("#DIV_" + position_hide).before($("#DIV_" + position_show));
        $('#BTN_' + position_show).attr('disabled', true);
        $('#BTN_' + position_show).addClass('btn-disabled');
        $('#BTN_' + position_hide).attr('disabled', false);
        $('#BTN_' + position_hide).addClass('btn-disabled');
        $('#ABOUT_POSITION').val(position_show);
    }
    $("#ABOUT_IMG").change(function() {
        var id_img_left = 'SHOWABOUT_IMG';
        readURL(this, id_img_left);
    });

    function submit_about() {
        $('#FRM_ABOUT').submit();
    }

    function deleteabout(thisdata) {
        var UNID = $(thisdata).data('unid');
        var url = "{{ route('about.delete') }}";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                UNID: UNID
            },
            success: function(response) {
                Swal.fire({
                    icon: response.alert,
                    title: response.title,
                    text: response.text,
                    timer: 1500
                }).then(function() {
                    location.reload();
                });
            }
        });
    }
</script>

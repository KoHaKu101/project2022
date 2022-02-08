$("#FRM_REGISTER").submit(function(e) {
            var url = $("#FRM_REGISTER").data('route');
            var data = $(this);
            var $inputs = $('#FRM_REGISTER :input');
            e.preventDefault();
            $inputs.each(function(index) {
                $('.HIDE_' + $(this).attr('id')).attr("hidden", true);
                $('.ER_' + $(this).attr('id')).removeClass("text-danger-edit");
            });
            $.ajax({
                type: "POST",
                url: url,
                data: data.serialize(),
                success: function(response) {
                    if (response.alert == 'error') {
                        $.each(response.massage, function(id, textname) {
                            $('.HIDE_' + id).removeAttr("hidden");
                            $('.ER_' + id).addClass("text-danger-edit");
                        });
                        Swal.fire({
                            icon: response.alert,
                            title: 'เกิดข้อผิดพลาด !',
                            text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
                        })
                    } else if (response.alert == 'success') {
                        Swal.fire({
                            icon: response.alert,
                            title: 'เข้าสู่ระบบ สำเร็จ !',
                            text: 'ยินดีต้อนรับเข้าสู่ระบบ',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
            });

        })

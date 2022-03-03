$("#FRM_LOGIN").submit(function(e) {
            var url = $("#FRM_LOGIN").data('route');
            var data = $(this);
            var $inputs = $('#FRM_LOGIN :input');
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
                        $.each(response.id, function(id, textname) {
                            $('.HIDE_' + id).removeAttr("hidden");
                            $('.ER_' + id).addClass("text-danger-edit");
                        });
                        Swal.fire({
                            icon: response.alert,
                            title: 'เกิดข้อผิดพลาด !',
                            timer: 1000,
                            text: response.massage,
                        })
                    } else if (response.alert == 'success') {
                        Swal.fire({
                            icon: response.alert,
                            title: 'เข้าสู่ระบบ สำเร็จ !',
                            text: 'ยินดีต้อนรับเข้าสู่ระบบ',
                            timer: 1500,
                        }).then(function(){
                                location.reload();
                        });
                    }

                },
            });

        })
